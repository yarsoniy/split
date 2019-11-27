<?php
namespace Company\Split\Tests\Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

use Codeception\Module\Doctrine2;
use Codeception\Module\REST;
use Codeception\Module\Symfony;
use Company\Split\Domain\Person\Person;
use Company\Split\Domain\Person\PersonId;
use Company\Split\Infrastructure\Security\User;
use Company\Split\Infrastructure\Security\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProfileHelper extends \Codeception\Module
{
    private $faker;

    /**
     * @return Generator
     */
    private function faker()
    {
        if (!$this->faker) {
            $this->faker = Factory::create();
            $this->faker->seed(1234);
        }

        return $this->faker;
    }

    private function encodePassword(User $user, $plainPassword)
    {
        /** @var Symfony $encoder */
        $module = $this->getModule('Symfony');

        /** @var UserPasswordEncoderInterface $encoder */
        $encoder = $module->_getContainer()->get(UserPasswordEncoderInterface::class);
        return $encoder->encodePassword($user, $plainPassword);
    }

    private function save($classNameOrInstance, $data = [])
    {
        /** @var Doctrine2 $module */
        $module = $this->getModule('Doctrine2');
        return $module->haveInRepository($classNameOrInstance, $data);
    }

    /**
     * Generates and saves a Person entity
     * @param array $fields
     * @return string
     */
    public function havePerson($fields = [])
    {
        $data = [
            'id' => $fields['id'] ?? $this->faker()->uuid,
            'name' => $fields['name'] ?? $this->faker()->name,
            'email' => $fields['email'] ?? $this->faker()->safeEmail,
        ];
        $data['id'] = new PersonId($data['id']);
        return (string)$this->save(Person::class, $data);
    }

    /**
     * @param array $fields
     * @return string
     */
    public function haveProfile($fields = [])
    {
        $f = $this->faker();
        $profileData = [
            'username' => $fields['username'] ?? $f->userName,
            'password' => $fields['password'] ?? $f->password,
            'fullName' => $fields['fullName'] ?? $f->name,
            'emailAddress' => $fields['password'] ?? $f->safeEmail,
        ];

        $personUuid = $this->havePerson([
            'name' => $profileData['fullName'],
            'email' => $profileData['emailAddress'],
        ]);

        //we need User instance, to encode a password
        $user = new User();
        $user->setId($personUuid);
        $user->setUsername($profileData['username']);

        $encoded = $this->encodePassword($user, $profileData['password']);
        $user->setPassword($encoded);

        return $this->save($user);
    }

    public function amAuthenticatedAs($username)
    {
        /** @var REST $module */
        $module = $this->getModule('REST');

        /** @var ContainerInterface $symfonyContainer */
        $symfonyContainer = $this->getModule('Symfony')->_getContainer();

        $user = $symfonyContainer->get(UserRepository::class)->findOneBy(['username' => $username]);
        if (!$user) {
            throw new \Exception("User with username '$username' not found");
        }

        $tokenManager = $symfonyContainer->get(JWTTokenManagerInterface::class);
        $token = $tokenManager->create($user);
        $module->haveHttpHeader('Authorization', 'Bearer ' . $token);
    }
}

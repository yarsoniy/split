<?php

namespace Company\Split\Infrastructure\Security;

use Company\Split\Application\Auth\AuthProvider;
use Company\Split\Application\Auth\UsernameIsNotUnique;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserService implements AuthProvider
{
    /** @var UserPasswordEncoderInterface  */
    private $passwordEncoder;

    /** @var UserRepository */
    private $repo;

    /** @var EntityManagerInterface  */
    private $em;

    public function __construct(
        UserPasswordEncoderInterface $encoder,
        EntityManagerInterface $objectManager,
        UserRepository $repository
    ) {
        $this->passwordEncoder = $encoder;
        $this->repo = $repository;
        $this->em = $objectManager;
    }

    /**
     * @param $id
     * @param string $username
     * @param string $password
     * @throws UsernameIsNotUnique
     */
    public function register($id, string $username, string $password)
    {
        $repo = $this->em->getRepository(User::class);
        if ($repo->findBy(['username' => $username])) {
            throw new UsernameIsNotUnique();
        }

        $user = new User();
        $user->setId($id);
        $user->setUsername($username);
        $user->setPassword($this->passwordEncoder->encodePassword($user, $password));

        $this->em->persist($user);
        $this->em->flush();
    }

    public function getUsername($id): string
    {
        return $this->repo->find($id)->getUsername();
    }
}

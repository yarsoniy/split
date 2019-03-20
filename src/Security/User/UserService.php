<?php

namespace Company\Split\Security\User;

use Company\Split\Infrastructure\UuidGenerator;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserService
 * @package Company\Split\Security\Service
 */
class UserService
{
    /** @var UuidGenerator  */
    private $idGenerator;

    /** @var UserPasswordEncoderInterface  */
    private $passwordEncoder;

    /** @var EntityManagerInterface  */
    private $em;

    /**
     * UserService constructor.
     * @param UuidGenerator $generator
     * @param UserPasswordEncoderInterface $encoder
     * @param EntityManagerInterface $objectManager
     */
    public function __construct(
        UuidGenerator $generator,
        UserPasswordEncoderInterface $encoder,
        EntityManagerInterface $objectManager
    ) {
        $this->idGenerator = $generator;
        $this->passwordEncoder = $encoder;
        $this->em = $objectManager;
    }

    /**
     * @param $username
     * @param $password
     * @return User
     * @throws UsernameOccupiedException
     */
    public function register($username, $password)
    {
        $user = new User();
        $user->setId($this->idGenerator->generate());
        $user->setUsername($username);
        $user->setPassword($this->passwordEncoder->encodePassword($user, $password));

        $this->em->persist($user);

        try {
            $this->em->flush();
        } catch (UniqueConstraintViolationException $e) {
            throw new UsernameOccupiedException('The username is occupied');
        }

        return $user;
    }
}

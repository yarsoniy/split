<?php

namespace Company\Split\Security\User;

use Company\Split\Application\Auth\AuthProvider;
use Company\Split\Application\Auth\UsernameIsNotUnique;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserService
 * @package Company\Split\Security\Service
 */
class UserService implements AuthProvider
{
    /** @var UserPasswordEncoderInterface  */
    private $passwordEncoder;

    /** @var UserRepository */
    private $repo;

    /** @var EntityManagerInterface  */
    private $em;

    /**
     * UserService constructor.
     * @param UserPasswordEncoderInterface $encoder
     * @param EntityManagerInterface $objectManager
     * @param UserRepository $repository
     */
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
        $user = new User();
        $user->setId($id);
        $user->setUsername($username);
        $user->setPassword($this->passwordEncoder->encodePassword($user, $password));

        $this->em->persist($user);

        try {
            $this->em->flush();
        } catch (UniqueConstraintViolationException $e) {
            throw new UsernameIsNotUnique();
        }
    }

    public function getUsername($id): string
    {
        return $this->repo->find($id)->getUsername();
    }
}

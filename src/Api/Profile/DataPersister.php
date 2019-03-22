<?php

namespace Company\Split\Api\Profile;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Company\Split\Application\Person\PersonService;
use Company\Split\Security\User\UsernameOccupiedException;
use Company\Split\Security\User\UserService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class DataPersister
 * @package Company\Split\Api\Profile
 */
class DataPersister implements DataPersisterInterface
{
    /** @var EntityManagerInterface  */
    private $em;

    /** @var UserService  */
    private $userService;

    /** @var PersonService  */
    private $personService;

    /**
     * DataPersister constructor.
     * @param EntityManagerInterface $em
     * @param UserService $userService
     * @param PersonService $personService
     */
    public function __construct(EntityManagerInterface $em, UserService $userService, PersonService $personService)
    {
        $this->em = $em;
        $this->userService = $userService;
        $this->personService = $personService;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data): bool
    {
        return $data instanceof Profile;
    }

    /**
     * {@inheritdoc}
     */
    public function persist($data)
    {
        $this->em->beginTransaction();
        try {
            $user = $this->userService->register($data->username, $data->password);
            $this->personService->createPerson($user->getId(), $data->name);
            $this->em->commit();
        } catch (UsernameOccupiedException $e) {
            $this->em->rollback();
            throw new HttpException(Response::HTTP_CONFLICT, $e->getMessage());
        }

        $profile = new Profile($user->getId());
        $profile->username = $data->username;
        $profile->name = $data->name;
        return $profile;
    }

    /**
     * {@inheritdoc}
     */
    public function remove($data)
    {
        // TODO: Implement remove() method.
    }
}

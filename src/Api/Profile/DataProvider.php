<?php

namespace Company\Split\Api\Profile;

use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use Company\Split\Domain\Person\PersonId;
use Company\Split\Domain\Person\PersonRepository;
use Company\Split\Security\User\User;
use Company\Split\Security\User\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class DataProvider
 * @package Company\Split\Api\Profile
 */
class DataProvider implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    /** @var PersonRepository  */
    private $personRepository;

    /** @var UserRepository */
    private $userRepository;

    /**
     * DataProvider constructor.
     * @param PersonRepository $personRepository
     * @param UserRepository $userRepository
     */
    public function __construct(PersonRepository $personRepository, UserRepository $userRepository)
    {
        $this->personRepository = $personRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return $resourceClass == Profile::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = [])
    {
        /** @var User $user */
        $user = $this->userRepository->find($id);
        $person = $this->personRepository->get(new PersonId($user->getId()));
        if (!$person) {
            throw new HttpException(Response::HTTP_UNPROCESSABLE_ENTITY, "Resource is broken");
        }

        $profile = new Profile($user->getId());
        $profile->username = $user->getUsername();
        $profile->name = $person->getName();

        return $profile;
    }
}

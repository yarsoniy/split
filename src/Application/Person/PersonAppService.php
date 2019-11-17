<?php

namespace Company\Split\Application\Person;

use Company\Split\Application\Auth\AuthProvider;
use Company\Split\Application\Auth\UsernameIsNotUnique;
use Company\Split\Application\Core\PersistenceProvider;
use Company\Split\Domain\Person\EmailOccupiedException;
use Company\Split\Domain\Person\Person;
use Company\Split\Domain\Person\PersonService;
use Company\Split\Domain\Person\PersonId;
use Company\Split\Domain\Person\PersonRepository;

/**
 * Class PersonService
 * @package Company\Split\Application\Person
 */
class PersonAppService
{
    /** @var PersistenceProvider  */
    private $persistence;

    /** @var AuthProvider */
    private $auth;

    /** @var PersonRepository  */
    private $repository;
    
    /** @var PersonService */
    private $domainService;

    public function __construct(
        PersistenceProvider $persistence,
        AuthProvider $auth,
        PersonRepository $repository,
        PersonService $domainService
    ) {
        $this->persistence = $persistence;
        $this->auth = $auth;
        $this->repository = $repository;
        $this->domainService = $domainService;
    }

    /**
     * @param $username
     * @param $password
     * @param $name
     * @param $email
     * @return Person
     * @throws UsernameIsNotUnique
     * @throws EmailOccupiedException
     */
    public function register($username, $password, $name, $email)
    {
        $this->persistence->beginTransaction();

        $person = $this->domainService->createPerson($name, $email);
        $this->auth->register($person->getId(), $username, $password);

        $this->persistence->commit();
        return $person;
    }

    public function find(string $id): ?Person
    {
        return $this->repository->get(new PersonId($id));
    }

    /**
     * @return Person[]
     */
    public function findAll(): array
    {
        return $this->repository->getAll();
    }
}

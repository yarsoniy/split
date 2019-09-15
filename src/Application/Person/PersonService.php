<?php

namespace Company\Split\Application\Person;

use Company\Split\Application\Auth\AuthProvider;
use Company\Split\Application\Auth\UsernameIsNotUnique;
use Company\Split\Application\Core\PersistenceProvider;
use Company\Split\Domain\Person\Person;
use Company\Split\Domain\Person\PersonId;
use Company\Split\Domain\Person\PersonRepository;

/**
 * Class PersonService
 * @package Company\Split\Application\Person
 */
class PersonService
{
    /** @var PersistenceProvider  */
    private $persistence;

    /** @var AuthProvider */
    private $auth;

    /** @var PersonRepository  */
    private $repository;

    /**
     * PersonService constructor.
     * @param PersistenceProvider $persistence
     * @param AuthProvider $auth
     * @param PersonRepository $repository
     */
    public function __construct(
        PersistenceProvider $persistence,
        AuthProvider $auth,
        PersonRepository $repository
    ) {
        $this->persistence = $persistence;
        $this->auth = $auth;
        $this->repository = $repository;
    }

    /**
     * @param $username
     * @param $password
     * @param $name
     * @param $email
     * @return Person
     * @throws UsernameIsNotUnique
     */
    public function register($username, $password, $name, $email)
    {
        $this->persistence->beginTransaction();

        $person = $this->createPerson($name, $email);
        $this->auth->register($person->getId(), $username, $password);

        $this->persistence->commit();

        return $person;
    }

    /**
     * @param string $name
     * @param string $email
     * @return Person
     */
    private function createPerson(string $name, string $email)
    {
        $person = new Person($this->repository->getNewId(), $name);
        $person->setEmail($email);
        $this->repository->add($person);
        $this->persistence->flush();

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

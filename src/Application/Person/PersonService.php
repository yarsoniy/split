<?php

namespace Company\Split\Application\Person;

use Company\Split\Application\Auth\AuthProvider;
use Company\Split\Application\Auth\UsernameIsNotUnique;
use Company\Split\Application\Core\PersistenceProvider;
use Company\Split\Domain\Person\Person;
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
     * @throws UsernameIsNotUnique
     */
    public function register($username, $password, $name)
    {
        $this->persistence->beginTransaction();

        $person = $this->createPerson($name);
        $this->auth->register($person->getId(), $username, $password);

        $this->persistence->commit();
    }

    /**
     * @param string $name
     * @return Person
     */
    private function createPerson(string $name)
    {
        $person = new Person($this->repository->getNewId(), $name);
        $this->repository->add($person);
        $this->persistence->flush();

        return $person;
    }
}

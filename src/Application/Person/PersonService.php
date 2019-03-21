<?php

namespace Company\Split\Application\Person;

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

    /** @var PersonRepository  */
    private $repository;

    /**
     * PersonService constructor.
     * @param PersistenceProvider $persistence
     * @param PersonRepository $repository
     */
    public function __construct(PersistenceProvider $persistence, PersonRepository $repository)
    {
        $this->persistence = $persistence;
        $this->repository = $repository;
    }

    /**
     * @param string $id
     * @param string $name
     */
    public function createPerson(string $id, string $name)
    {
        $personId = new PersonId($id);
        $person = new Person($personId, $name);
        $this->repository->add($person);
        $this->persistence->flush();
    }
}

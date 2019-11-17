<?php

namespace Company\Split\Domain\Person;

class PersonService
{
    /** @var PersonRepository */
    private $personRepo;

    public function __construct(
        PersonRepository $personRepository
    ) {
        $this->personRepo = $personRepository;
    }

    /**
     * @param string $name
     * @param string $email
     * @return Person
     * @throws EmailOccupiedException
     */
    public function createPerson(string $name, string $email)
    {
        $newId = $this->personRepo->getNewId();
        $person = new Person($newId, $name);
        $person->setEmail($email);

        $personWithSameEmail = $this->personRepo->getByEmail($email);
        if ($personWithSameEmail) {
            throw new EmailOccupiedException();
        }

        $this->personRepo->add($person);
        return $person;
    }
}

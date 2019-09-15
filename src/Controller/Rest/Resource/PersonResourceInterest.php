<?php

namespace Company\Split\Controller\Rest\Resource;

use Company\Split\Domain\Person\Person;
use Company\Split\Domain\Person\PersonInterest;

class PersonResourceInterest implements PersonInterest
{
    /** @var PersonResource  */
    private $holder;

    public function enquire(Person $person): PersonResource
    {
        $this->holder = new PersonResource();
        $person->fillInterest($this);
        return $this->holder;
    }

    public function setId(string $id)
    {
        $this->holder->id = $id;
    }

    public function setName(string $name)
    {
        $this->holder->fullName = $name;
    }

    public function setEmail(string $email)
    {
        $this->holder->emailAddress = $email;
    }
}

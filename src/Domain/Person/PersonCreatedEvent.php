<?php

namespace Company\Split\Domain\Person;

use Company\Split\Domain\Core\DomainEvent;

class PersonCreatedEvent extends DomainEvent
{
    private $personId;

    private $whenOccurred;

    public function __construct(PersonId $personId)
    {
        $this->personId = $personId;
        $this->whenOccurred = new \DateTimeImmutable();
    }

    public function getPersonId()
    {
        return $this->personId;
    }

    public function getWhenOccurred()
    {
        return $this->whenOccurred;
    }
}

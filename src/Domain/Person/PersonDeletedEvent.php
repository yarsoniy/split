<?php

namespace Company\Split\Domain\Person;

use Company\Split\Domain\Core\DomainEvent;

class PersonDeletedEvent extends DomainEvent
{
    private $personId;

    private $whenOccurred;

    public function __construct(PersonId $id)
    {
        $this->personId = $id;
        $this->whenOccurred = new \DateTimeImmutable();
    }
}

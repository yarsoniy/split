<?php

namespace Company\Split\Infrastructure\DoctrineCustomType;

use Company\Split\Domain\Person\PersonId;

class PersonIdType extends IdentityType
{
    protected const CUSTOM_NAME = 'person_id';
    protected const CUSTOM_TYPE = PersonId::class;
}

<?php

namespace Company\Split\Infrastructure\Doctrine\CustomType;

use Company\Split\Domain\Person\PersonId;

/**
 * Class PersonIdType
 * @package Company\Split\Infrastructure\ORM\CustomMappingTypes
 */
class PersonIdType extends IdentityType
{
    protected const CUSTOM_NAME = 'person_id';
    protected const CUSTOM_TYPE = PersonId::class;
}

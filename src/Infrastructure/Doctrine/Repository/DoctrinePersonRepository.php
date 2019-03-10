<?php

namespace Company\Split\Infrastructure\Doctrine\Repository;

use Company\Split\Domain\Person\Person;
use Company\Split\Domain\Person\PersonId;
use Company\Split\Domain\Person\PersonRepository;

/**
 * Class DoctrinePersonRepository
 * @package Company\Split\Infrastructure\Doctrine\Repository
 *
 * @method PersonId getNewId()
 * @method add(Person $aggregate)
 * @method Person|null get(PersonId $id)
 */
class DoctrinePersonRepository extends DoctrineDomainRepository implements PersonRepository
{
    protected const ENTITY_CLASS = Person::class;
    protected const ID_CLASS = PersonId::class;
}

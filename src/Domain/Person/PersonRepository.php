<?php

namespace Company\Split\Domain\Person;

use Company\Split\Domain\Core\DomainRepository;

/**
 * Interface PersonRepository
 * @package Company\Split\Domain\Person
 *
 * @method PersonId getNewId()
 * @method add(Person $aggregate)
 * @method Person|null get(PersonId $id)
 * @method Person[] getAll()
 */
interface PersonRepository extends DomainRepository
{
}

<?php

namespace Company\Split\Domain\Core;

/**
 * Interface Repository
 * @package Company\Split\Domain\Core
 */
interface DomainRepository
{
    /**
     * @return Identity
     */
    public function getNewId(): Identity;

    /**
     * @param AggregateRoot $aggregate
     */
    public function add(AggregateRoot $aggregate);

    /**
     * @param Identity $id
     * @return AggregateRoot|null
     */
    public function get(Identity $id): ?AggregateRoot;
}

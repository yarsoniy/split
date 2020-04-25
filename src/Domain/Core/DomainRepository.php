<?php

namespace Company\Split\Domain\Core;

interface DomainRepository
{
    public function getNewId(): Identity;

    public function add(AggregateRoot $aggregate);

    public function get(Identity $id): ?AggregateRoot;

    /**
     * @return AggregateRoot[]
     */
    public function getAll(): array;
}

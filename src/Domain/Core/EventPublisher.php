<?php

namespace Company\Split\Domain\Core;

/**
 * Interface EventPublisher
 * @package Company\Split\Domain\Core
 */
interface EventPublisher
{
    /**
     * @param DomainEvent $event
     */
    public function pub(DomainEvent $event): void;
}

<?php


namespace Company\Split\Infrastructure;

use Company\Split\Domain\Core\DomainEvent;
use Company\Split\Domain\Core\DomainEventPublisher;

class DomainEventPublisherImpl extends DomainEventPublisher
{
    /** @var DomainEvent[] */
    private $publishedEvents = [];

    protected function publishEvent(DomainEvent $event)
    {
        $this->publishedEvents[] = $event;
    }
}

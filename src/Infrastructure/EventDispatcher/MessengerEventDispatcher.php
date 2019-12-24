<?php

namespace Company\Split\Infrastructure\EventDispatcher;

use Company\Split\Domain\Core\DomainEvent;
use Company\Split\Domain\Core\EventDispatcher;
use Symfony\Component\Messenger\MessageBusInterface;

class MessengerEventDispatcher implements EventDispatcher
{
    /** @var MessageBusInterface */
    private $eventBus;

    /** @var DomainEvent[] */
    private $events = [];

    private $isDispatchingStarted = false;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    public function add(DomainEvent $event): void
    {
        $this->events[] = $event;
    }

    public function dispatch(): void
    {
        if ($this->isDispatchingStarted) {
            return;
        }

        $this->isDispatchingStarted = true;
        while (count($this->events)) {
            $event = array_shift($this->events);
            $this->eventBus->dispatch($event);
        }
        $this->isDispatchingStarted = false;
    }
}

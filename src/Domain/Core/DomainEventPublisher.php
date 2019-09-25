<?php

namespace Company\Split\Domain\Core;

use Company\Split\GlobalRegistry;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class DomainEventPublisher
{
    public static function publish(DomainEvent $event): void
    {
        $instance = self::getInstance();
        $instance->publishEvent($event);
    }

    protected static function getInstance(): self
    {
        //TODO hide somewhere outside of the Domain
        $container =  GlobalRegistry::get(ContainerInterface::class);
        return $container->get(DomainEventPublisher::class);
    }

    abstract protected function publishEvent(DomainEvent $event);
}

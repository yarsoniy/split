<?php

namespace Company\Split\Domain\Core;

abstract class DomainEventPublisher
{
    /**
     * Callable returning an instance.
     * (Callable, because we want to instantiate only when needed)
     * @var callable
     */
    private static $instanceFactory;

    private static function getInstance(): self
    {
        $factory = self::$instanceFactory;
        return $factory();
    }

    public static function initInstanceFactory(callable $factory)
    {
        self::$instanceFactory = $factory;
    }

    public static function publish(DomainEvent $event): void
    {
        self::getInstance()->publishEvent($event);
    }

    abstract protected function publishEvent(DomainEvent $event);
}

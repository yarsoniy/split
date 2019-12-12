<?php

namespace Company\Split\Domain\Core;

use Psr\Container\ContainerInterface;

/**
 * Static Facade class
 * Using this facade you can access the inner service globally
 * @package Company\Split\Domain\Core
 */
class EventDispatcherFacade
{
    /** @var ContainerInterface */
    private static $container;

    public static function setContainer(ContainerInterface $container)
    {
        static::$container = $container;
    }

    private static function getInstance(): EventDispatcher
    {
        //we can't use dependency injection in a static context
        //that's why we have to interact with the container directly
        return static::$container->get(EventDispatcher::class);
    }

    public static function add(DomainEvent $event)
    {
        static::getInstance()->add($event);
    }
}

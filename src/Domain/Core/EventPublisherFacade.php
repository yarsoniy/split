<?php

namespace Company\Split\Domain\Core;

use Psr\Container\ContainerInterface;

/**
 * Static Facade class
 * Using this facade you can access the inner service globally
 * @package Company\Split\Domain\Core
 */
class EventPublisherFacade
{
    /** @var ContainerInterface */
    private static $container;

    public static function setContainer(ContainerInterface $container)
    {
        static::$container = $container;
    }

    private static function getInstance()
    {
        return static::$container->get(EventPublisher::class);
    }

    public static function pub(DomainEvent $event)
    {
        static::getInstance()->pub($event);
    }
}

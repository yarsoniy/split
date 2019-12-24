<?php

namespace Company\Split\Domain\Core;

interface EventDispatcher
{
    public function add(DomainEvent $event): void;

    public function dispatch(): void;
}

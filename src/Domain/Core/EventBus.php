<?php

namespace Company\Split\Domain\Core;

interface EventBus
{
    public function add(DomainEvent $event): void;

    public function dispatch(): void;
}

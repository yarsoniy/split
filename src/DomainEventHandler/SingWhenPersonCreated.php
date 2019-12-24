<?php

namespace Company\Split\DomainEventHandler;

use Company\Split\Domain\Person\PersonCreatedEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

class SingWhenPersonCreated implements MessageHandlerInterface
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function __invoke(PersonCreatedEvent $event): void
    {
        $this->logger->info("I'm singing. Id: " . $event->getPersonId());
        return;
    }
}

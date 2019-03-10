<?php

namespace Company\Split\Infrastructure;

use Company\Split\Domain\Core\IdGenerator;
use Ramsey\Uuid\Uuid;

/**
 * Class UuidGenerator
 * @package Company\Split\Infrastructure
 */
class UuidGenerator implements IdGenerator
{
    /**
     * @return string
     * @throws \Exception
     */
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}

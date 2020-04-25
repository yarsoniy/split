<?php

namespace Company\Split\Infrastructure\IdGenerator;

use Company\Split\Domain\Core\IdGenerator;
use Ramsey\Uuid\Uuid;

class UuidGenerator implements IdGenerator
{
    public function generate(): string
    {
        return Uuid::uuid4()->toString();
    }
}

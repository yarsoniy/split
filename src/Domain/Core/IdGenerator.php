<?php

namespace Company\Split\Domain\Core;

/**
 * Interface IdGenerator
 * @package Company\Split\Domain\Core
 */
interface IdGenerator
{
    /**
     * @return string
     */
    public function generate(): string;
}

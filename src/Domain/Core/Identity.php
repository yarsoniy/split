<?php

namespace Company\Split\Domain\Core;

/**
 * Class Identity
 * @package Company\Split\Domain\Core
 */
abstract class Identity
{
    /**
     * @var string
     */
    protected $value;

    /**
     * Identity constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }
}

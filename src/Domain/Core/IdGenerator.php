<?php

namespace Company\Split\Domain\Core;

interface IdGenerator
{
    public function generate(): string;
}

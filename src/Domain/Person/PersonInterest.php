<?php

namespace Company\Split\Domain\Person;

interface PersonInterest
{
    public function setId(string $id);
    public function setName(string $name);
    public function setEmail(string $email);
}

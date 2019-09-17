<?php

namespace Company\Split\Domain\Person;

interface PersonDataPicker
{
    public function setId(string $id);
    public function setName(string $name);
    public function setEmail(string $email);
}

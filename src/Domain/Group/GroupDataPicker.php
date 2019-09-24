<?php

namespace Company\Split\Domain\Group;

interface GroupDataPicker
{
    public function setId(string $id);
    public function setName(string $name);
    public function setWhenCreated(\DateTimeImmutable $date);
}

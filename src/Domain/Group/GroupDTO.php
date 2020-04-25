<?php

namespace Company\Split\Domain\Group;

use DateTimeImmutable;

class GroupDTO
{
    /** @var GroupId */
    public $id;

    /** @var string */
    public $name;

    /** @var DateTimeImmutable */
    public $whenCreated;
}

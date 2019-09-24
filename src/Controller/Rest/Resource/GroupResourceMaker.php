<?php

namespace Company\Split\Controller\Rest\Resource;

use Company\Split\Domain\Group\Group;
use Company\Split\Domain\Group\GroupDataPicker;

class GroupResourceMaker implements GroupDataPicker
{
    /** @var GroupResource */
    private $resource;

    public function makeFromGroup(Group $group): GroupResource
    {
        $this->resource = new GroupResource();
        $group->dumpData($this);
        $result = $this->resource;
        $this->resource = null;

        return $result;
    }

    public function setId(string $id)
    {
        $this->resource->id = $id;
    }

    public function setName(string $name)
    {
        $this->resource->name = $name;
    }

    public function setWhenCreated(\DateTimeImmutable $date)
    {
        $this->resource->whenCreated = $date;
    }
}

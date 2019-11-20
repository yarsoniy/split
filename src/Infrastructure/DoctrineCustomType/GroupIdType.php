<?php

namespace Company\Split\Infrastructure\DoctrineCustomType;

use Company\Split\Domain\Group\GroupId;

class GroupIdType extends IdentityType
{
    protected const CUSTOM_NAME = 'group_id';
    protected const CUSTOM_TYPE = GroupId::class;
}

<?php

namespace Company\Split\Infrastructure\Doctrine\CustomType;

use Company\Split\Domain\Group\GroupId;

/**
 * Class GroupIdType
 * @package Company\Split\Infrastructure\Doctrine\CustomType
 */
class GroupIdType extends IdentityType
{
    protected const CUSTOM_NAME = 'group_id';
    protected const CUSTOM_TYPE = GroupId::class;
}

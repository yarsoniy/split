<?php

namespace Company\Split\Infrastructure\Doctrine\CustomType;

use Company\Split\Domain\Group\MemberId;

/**
 * Class MemberIdType
 * @package Company\Split\Infrastructure\Doctrine\CustomType
 */
class MemberIdType extends IdentityType
{
    protected const CUSTOM_NAME = 'member_id';
    protected const CUSTOM_TYPE = MemberId::class;
}

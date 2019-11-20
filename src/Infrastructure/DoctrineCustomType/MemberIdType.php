<?php

namespace Company\Split\Infrastructure\DoctrineCustomType;

use Company\Split\Domain\Member\MemberId;

class MemberIdType extends IdentityType
{
    protected const CUSTOM_NAME = 'member_id';
    protected const CUSTOM_TYPE = MemberId::class;
}

<?php

namespace Company\Split\Infrastructure\Repository\Member;

use Company\Split\Domain\Member\Member;
use Company\Split\Domain\Member\MemberId;
use Company\Split\Domain\Member\MemberRepository;
use Company\Split\Infrastructure\Repository\DoctrineRepository;

/**
 * @method MemberId getNewId()
 * @method add(Member $group)
 * @method Member|null get(MemberId $id)
 * @method Member[] getAll()
 */
class MemberDoctrineRepository extends DoctrineRepository implements MemberRepository
{
    protected const ENTITY_CLASS = Member::class;
    protected const ID_CLASS = MemberId::class;
}

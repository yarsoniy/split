<?php

namespace Company\Split\Infrastructure\Repository;

use Company\Split\Domain\Member\Member;
use Company\Split\Domain\Member\MemberId;
use Company\Split\Domain\Member\MemberRepository;

/**
 * @method MemberId getNewId()
 * @method add(Member $group)
 * @method Member|null get(MemberId $id)
 * @method Member[] getAll()
 */
class DoctrineMemberRepository extends DoctrineRepository implements MemberRepository
{
    protected const ENTITY_CLASS = Member::class;
    protected const ID_CLASS = MemberId::class;
}

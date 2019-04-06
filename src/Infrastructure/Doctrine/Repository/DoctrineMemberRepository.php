<?php

namespace Company\Split\Infrastructure\Doctrine\Repository;

use Company\Split\Domain\Member\Member;
use Company\Split\Domain\Member\MemberId;
use Company\Split\Domain\Member\MemberRepository;

/**
 * Class DoctrineMemberRepository
 * @package Company\Split\Infrastructure\Doctrine\Repository
 *
 * @method MemberId getNewId()
 * @method add(Member $group)
 * @method Member|null get(MemberId $id)
 */
class DoctrineMemberRepository extends DoctrineDomainRepository implements MemberRepository
{
    protected const ENTITY_CLASS = Member::class;
    protected const ID_CLASS = MemberId::class;
}

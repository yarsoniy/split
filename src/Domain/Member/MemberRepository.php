<?php

namespace Company\Split\Domain\Member;

use Company\Split\Domain\Core\DomainRepository;

/**
 * Interface MemberRepository
 * @package Company\Split\Domain\Member
 *
 * @method MemberId getNewId()
 * @method add(Member $group)
 * @method Member|null get(MemberId $id)
 * @method Member[] getAll()
 */
interface MemberRepository extends DomainRepository
{
}

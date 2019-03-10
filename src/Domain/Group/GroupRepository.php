<?php

namespace Company\Split\Domain\Group;

use Company\Split\Domain\Core\DomainRepository;

/**
 * Interface GroupRepository
 * @package Company\Split\Domain\Group
 *
 * @method GroupId getNewId()
 * @method add(Group $group)
 * @method Group|null get(GroupId $id)
 */
interface GroupRepository extends DomainRepository
{
}

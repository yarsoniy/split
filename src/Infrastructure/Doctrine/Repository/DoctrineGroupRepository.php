<?php

namespace Company\Split\Infrastructure\Doctrine\Repository;

use Company\Split\Domain\Group\Group;
use Company\Split\Domain\Group\GroupId;
use Company\Split\Domain\Group\GroupRepository;

/**
 * Class DoctrineGroupRepository
 * @package Company\Split\Infrastructure\Doctrine\Repository
 *
 * @method GroupId getNewId()
 * @method add(Group $group)
 * @method Group|null get(GroupId $id)
 */
class DoctrineGroupRepository extends DoctrineDomainRepository implements GroupRepository
{
    protected const ENTITY_CLASS = Group::class;
    protected const ID_CLASS = GroupId::class;
}

<?php

namespace Company\Split\Infrastructure\Repository;

use Company\Split\Domain\Group\Group;
use Company\Split\Domain\Group\GroupId;
use Company\Split\Domain\Group\GroupRepository;

/**
 * @method GroupId getNewId()
 * @method add(Group $group)
 * @method Group|null get(GroupId $id)
 * @method Group[] getAll()
 */
class DoctrineGroupRepository extends DoctrineRepository implements GroupRepository
{
    protected const ENTITY_CLASS = Group::class;
    protected const ID_CLASS = GroupId::class;
}

<?php

namespace Company\Split\Infrastructure\Repository\Group;

use Company\Split\Domain\Group\Group;
use Company\Split\Domain\Group\GroupId;
use Company\Split\Domain\Group\GroupRepository;
use Company\Split\Infrastructure\Repository\DoctrineRepository;

/**
 * @method GroupId getNewId()
 * @method add(Group $group)
 * @method Group|null get(GroupId $id)
 * @method Group[] getAll()
 */
class GroupDoctrineRepository extends DoctrineRepository implements GroupRepository
{
    protected const ENTITY_CLASS = Group::class;
    protected const ID_CLASS = GroupId::class;
}

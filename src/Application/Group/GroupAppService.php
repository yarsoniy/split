<?php

namespace Company\Split\Application\Group;

use Company\Split\Application\Core\PersistenceProvider;
use Company\Split\Domain\Group\Group;
use Company\Split\Domain\Group\GroupId;
use Company\Split\Domain\Group\GroupRepository;

class GroupAppService
{
    /** @var PersistenceProvider  */
    private $persistence;

    /** @var GroupRepository  */
    private $groupRepo;

    public function __construct(
        PersistenceProvider $persistence,
        GroupRepository $groupRepo
    ) {
        $this->persistence = $persistence;
        $this->groupRepo = $groupRepo;
    }

    public function create($name): Group
    {
        $group = new Group($this->groupRepo->getNewId(), $name);
        $this->groupRepo->add($group);
        $this->persistence->flush();

        return $group;
    }

    public function find(string $id): Group
    {
        return $this->groupRepo->get(new GroupId($id));
    }

    /**
     * @return Group[]
     */
    public function findAll(): array
    {
        return $this->groupRepo->getAll();
    }
}

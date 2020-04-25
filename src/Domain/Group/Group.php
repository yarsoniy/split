<?php

namespace Company\Split\Domain\Group;

use Company\Split\Domain\Core\AggregateRoot;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Group
 * @package Company\Split\Domain\Group
 * @ORM\Entity()
 * @ORM\Table(name="domain_groups")
 */
class Group implements AggregateRoot
{
    /**
     * @var GroupId
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="group_id")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     */
    private $whenCreated;

    public function __construct(GroupId $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->whenCreated = new DateTimeImmutable('now');
    }

    public function toDTO(): GroupDTO
    {
        $dto = new GroupDTO();
        $dto->id = $this->id;
        $dto->name = $this->name;
        $dto->whenCreated = $this->whenCreated;

        return $dto;
    }
}

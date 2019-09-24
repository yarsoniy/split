<?php

namespace Company\Split\Domain\Group;

use Company\Split\Domain\Core\AggregateRoot;
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
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     */
    private $whenCreated;

    /**
     * Group constructor.
     * @param GroupId $id
     * @param string $name
     */
    public function __construct(GroupId $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        try {
            $this->whenCreated = new \DateTimeImmutable('now');
        } catch (\Exception $e) {}
    }

    public function dumpData(GroupDataPicker $picker)
    {
        $picker->setId($this->id);
        $picker->setName($this->name);
        $picker->setWhenCreated($this->whenCreated);
    }
}

<?php

namespace Company\Split\Domain\Member;

use Company\Split\Domain\Core\AggregateRoot;
use Company\Split\Domain\Group\GroupId;
use Company\Split\Domain\Person\PersonId;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Member
 * @package Company\Split\Domain\Member
 * @ORM\Entity()
 * @ORM\Table(name="domain_members")
 */
class Member implements AggregateRoot
{
    /**
     * @var MemberId
     * @ORM\Id()
     * @ORM\Column(type="member_id")
     */
    private $id;

    /**
     * @var GroupId
     * @ORM\Column(type="group_id", nullable=true)
     */
    private $groupId;

    /**
     * @var PersonId
     * @ORM\Column(type="person_id", nullable=true)
     */
    private $personId;

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
     * Member constructor.
     * @param MemberId $id
     * @param string $name
     * @param GroupId $groupId
     */
    public function __construct(MemberId $id, GroupId $groupId, string $name)
    {
        $this->id = $id;
        $this->groupId = $groupId;
        $this->name = $name;

        try {
            $this->whenCreated = new \DateTimeImmutable('now');
        } catch (\Exception $e) {}
    }

    /**
     * @return MemberId
     */
    public function getId(): MemberId
    {
        return $this->id;
    }

    /**
     * @param PersonId $personId
     */
    public function assignPerson(PersonId $personId)
    {
        $this->personId = $personId;
    }
}

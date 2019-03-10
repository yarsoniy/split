<?php

namespace Company\Split\Domain\Group;

use Company\Split\Domain\Money\Money;
use Company\Split\Domain\Person\PersonId;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Member
 * @package Company\Split\Domain\Group
 * @ORM\Entity()
 * @ORM\Table(name="domain_members")
 */
class Member
{
    /**
     * @var MemberId
     * @ORM\Id()
     * @ORM\Column(type="member_id")
     */
    private $id;

    /**
     * @var Group
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="members")
     */
    private $group;

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
     * @var Money
     * @ORM\Embedded(class="Company\Split\Domain\Money\Money")
     */
    private $balance;

    /**
     * @var \DateTimeImmutable
     * @ORM\Column(type="datetime_immutable")
     */
    private $whenCreated;

    /**
     * Member constructor.
     * @param MemberId $id
     * @param string $name
     * @param Group $group
     */
    public function __construct(MemberId $id, string $name, Group $group)
    {
        $this->id = $id;
        $this->name = $name;
        $this->group = $group;
        $this->balance = new Money();

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

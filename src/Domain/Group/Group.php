<?php

namespace Company\Split\Domain\Group;

use Company\Split\Domain\Core\AggregateRoot;
use Company\Split\Domain\Core\IdGenerator;
use Company\Split\Domain\Person\Person;
use Doctrine\Common\Collections\ArrayCollection;
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
     * @var Member[]
     * @ORM\OneToMany(
     *     targetEntity="Member",
     *     mappedBy="group",
     *     indexBy="id",
     *     cascade={"persist", "remove"},
     *     orphanRemoval=true
     * )
     */
    private $members;

    /**
     * Group constructor.
     * @param GroupId $id
     * @param string $name
     */
    public function __construct(GroupId $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->members = new ArrayCollection();
    }

    /**
     * @param $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $memberName
     * @param IdGenerator $generator
     */
    public function addMember(IdGenerator $generator, string $memberName)
    {
        $member = $this->createMember($generator, $memberName);
        $this->members[(string)$member->getId()] = $member;
    }

    /**
     * @param IdGenerator $generator
     * @param Person $person
     */
    public function addPersonalizedMember(IdGenerator $generator, Person $person)
    {
        $member = $this->createMember($generator, $person->getName());
        $member->assignPerson($person->getId());
        $this->members[(string)$member->getId()] = $member;
    }

    /**
     * @param IdGenerator $generator
     * @param string $memberName
     * @return Member
     */
    private function createMember(IdGenerator $generator, string $memberName)
    {
        $memberId = new MemberId($generator->generate());
        return new Member($memberId, $memberName, $this);
    }
}

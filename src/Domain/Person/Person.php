<?php

namespace Company\Split\Domain\Person;

use Company\Split\Domain\Core\AggregateRoot;
use Company\Split\Domain\Core\IdGenerator;
use Company\Split\Domain\Group\Group;
use Company\Split\Domain\Group\GroupId;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Participant
 * @package Company\Split\Domain\Person
 * @ORM\Entity()
 * @ORM\Table(name="domain_people")
 */
class Person implements AggregateRoot
{
    /**
     * @var PersonId
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\Column(type="person_id")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * Person constructor.
     * @param PersonId $id
     * @param string $name
     */
    public function __construct(PersonId $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return PersonId
     */
    public function getId(): PersonId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}

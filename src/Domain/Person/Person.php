<?php

namespace Company\Split\Domain\Person;

use Company\Split\Domain\Core\AggregateRoot;
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
     * @var string
     * @ORM\Column(type="string")
     */
    private $email;

    public function __construct(PersonId $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): PersonId
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function toDTO(): PersonDTO
    {
        $dto = new PersonDTO();
        $dto->id = $this->id;
        $dto->name = $this->name;
        $dto->email = $this->email;
        $dto->email = $this->email;

        return $dto;
    }
}

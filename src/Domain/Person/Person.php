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

    /**
     * @param string $email
     */
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

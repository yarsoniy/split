<?php

namespace Company\Split\Controller\Rest\Resource;

use JMS\Serializer\Annotation\Type;

class Test
{
    /**
     * @var string
     * @Type("string")
     */
    private $name;

    /**
     * @var int
     * @Type("int")
     */
    private $age;

    /**
     * @var Animal
     * @Type("Company\Split\Controller\Rest\Resource\Animal")
     */
    private $animal;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getAge(): int
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    public function setAnimal(?Animal $animal)
    {
        $this->animal = $animal;
    }

    public function getAnimal(): ?Animal
    {
        return $this->animal;
    }
}

<?php

namespace Company\Split\Controller\Rest\DTO;

use JMS\Serializer\Annotation\Type;

class TestDTO
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
     * TestDTO constructor.
     * @param string $name
     * @param int $age
     */
    public function __construct(string $name, int $age)
    {
        $this->name = 'Ivan';
        $this->age = $age;
    }
}
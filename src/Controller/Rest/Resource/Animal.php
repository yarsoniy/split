<?php

namespace Company\Split\Controller\Rest\Resource;

use JMS\Serializer\Annotation\Type;

class Animal
{
    /**
     * @var string
     * @Type("string")
     */
    private $family;

    /**
     * @var string
     * @Type("string")
     */
    private $color;

    /**
     * @var int
     * @Type("int")
     */
    private $legsCount;

    /**
     * Animal constructor.
     * @param string $family
     * @param string $color
     * @param int $legsCount
     */
    public function __construct(string $family, string $color, int $legsCount)
    {
        $this->family = $family;
        $this->color = $color;
        $this->legsCount = $legsCount;
    }
}

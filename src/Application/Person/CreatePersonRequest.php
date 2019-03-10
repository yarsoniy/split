<?php

namespace Company\Split\Application\Person;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class CreatePersonRequest
 * @package Company\Split\Application\Person
 */
class CreatePersonRequest
{
    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Length(max="100")
     */
    private $name;

    /**
     * CreatePersonRequest constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}

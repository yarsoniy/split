<?php

namespace Company\Split\Api\Profile;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Profile
 * @package Company\Split\Api\Profile
 *
 * @ApiResource(
 *     collectionOperations={"post"},
 *     itemOperations={"get"}
 * )
 */
class Profile
{
    /**
     * @var string
     * @ApiProperty(identifier=true)
     */
    private $id;

    /**
     * Your login name
     * @var string
     * @Assert\NotBlank()
     */
    public $username;

    /**
     * Your password
     * @var string password
     * @Assert\NotBlank()
     * @Assert\Length(min=4)
     */
    public $password = '';

    /**
     * Your name
     * @var string
     * @Assert\NotBlank()
     */
    public $name;

    /**
     * Profile constructor.
     * @param $id
     */
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }
}

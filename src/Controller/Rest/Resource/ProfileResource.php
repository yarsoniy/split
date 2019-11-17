<?php

namespace Company\Split\Controller\Rest\Resource;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

class ProfileResource
{
    /**
     * @var string
     * @Type("string")
     * @Serializer\Groups({"Created"})
     */
    public $id;

    /**
     * @var string
     * @Type("string")
     * @Assert\NotBlank
     */
    public $username;

    /**
     * @var string
     * @Type("string")
     * @Serializer\Groups({"Secure"})
     * @Assert\NotBlank
     */
    public $password;

    /**
     * @var string
     * @Type("string")
     * @Assert\NotBlank
     */
    public $fullName;

    /**
     * @var string
     * @Type("string")
     * @Assert\NotBlank
     * @Assert\Email
     */
    public $emailAddress;
}

<?php

namespace Company\Split\Controller\Rest\Resource;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;

class PersonResource
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
     */
    public $username;

    /**
     * @var string
     * @Type("string")
     * @Serializer\Groups({"Secure"})
     */
    public $password;

    /**
     * @var string
     * @Type("string")
     */
    public $fullName;

    /**
     * @var string
     * @Type("string")
     */
    public $emailAddress;
}

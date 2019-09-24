<?php

namespace Company\Split\Controller\Rest\Resource;

use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Swagger\Annotations as SWG;

class GroupResource
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
    public $name;

    /**
     * @var \DateTimeImmutable
     * @Type("DateTimeImmutable<'Y-m-d H:i:s'>")
     * @SWG\Property(type="string", pattern="Y-m-d H:i:s")
     * @Serializer\Groups({"Created"})
     */
    public $whenCreated;
}
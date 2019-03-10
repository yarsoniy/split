<?php

namespace Company\Split\Infrastructure\Doctrine\CustomType;

use Company\Split\Domain\Core\Identity;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

/**
 * Class IdentityType
 * @package Company\Split\Infrastructure\ORM\CustomMappingTypes
 */
abstract class IdentityType extends GuidType
{
    /** @var string Mapping name */
    protected const CUSTOM_NAME = 'identity';

    /** @var string Your custom type class name */
    protected const CUSTOM_TYPE = Identity::class;

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return static::CUSTOM_NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (is_null($value)) {
            return null;
        }

        $identityClass = static::CUSTOM_TYPE;
        return new $identityClass($value);
    }
}

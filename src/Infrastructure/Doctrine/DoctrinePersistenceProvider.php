<?php

namespace Company\Split\Infrastructure\Doctrine;

use Company\Split\Application\Core\PersistenceProvider;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class DoctrinePersistenceProvider
 * @package Company\Split\Infrastructure\Doctrine
 */
class DoctrinePersistenceProvider implements PersistenceProvider
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * DoctrinePersistenceProvider constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function flush()
    {
        $this->em->flush();
    }
}
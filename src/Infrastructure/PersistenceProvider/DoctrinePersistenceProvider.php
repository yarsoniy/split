<?php

namespace Company\Split\Infrastructure\PersistenceProvider;

use Company\Split\Application\Core\PersistenceProvider;
use Doctrine\ORM\EntityManagerInterface;

class DoctrinePersistenceProvider implements PersistenceProvider
{
    /** @var EntityManagerInterface */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function flush()
    {
        $this->em->flush();
    }

    public function beginTransaction()
    {
        $this->em->beginTransaction();
    }

    public function commit()
    {
        $this->em->commit();
    }

    public function rollback()
    {
        $this->em->rollback();
    }
}

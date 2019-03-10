<?php

namespace Company\Split\Infrastructure\Doctrine\Repository;

use Company\Split\Domain\Core\AggregateRoot;
use Company\Split\Domain\Core\Identity;
use Company\Split\Domain\Core\IdGenerator;
use Company\Split\Domain\Core\DomainRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class DoctrineDomainRepository
 * @package Company\Split\Infrastructure\Doctrine\Repository
 *
 * @method AggregateRoot|null find($id, $lockMode = null, $lockVersion = null)
 */
abstract class DoctrineDomainRepository extends ServiceEntityRepository implements DomainRepository
{
    /** @var string  */
    protected const ENTITY_CLASS = '';

    /** @var string  */
    protected const ID_CLASS = '';

    /**
     * @var IdGenerator
     */
    protected $idGenerator;

    /**
     * DoctrineDomainRepository constructor.
     * @param ManagerRegistry $registry
     * @param IdGenerator $generator
     */
    public function __construct(ManagerRegistry $registry, IdGenerator $generator)
    {
        parent::__construct($registry, static::ENTITY_CLASS);
        $this->idGenerator = $generator;
    }

    /**
     * @return Identity
     */
    public function getNewId(): Identity
    {
        $rawId = $this->idGenerator->generate();
        $idClass = static::ID_CLASS;
        return new $idClass($rawId);
    }

    /**
     * @param AggregateRoot $aggregate
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(AggregateRoot $aggregate)
    {
        $this->getEntityManager()->persist($aggregate);
    }

    /**
     * @param Identity $id
     * @return AggregateRoot|null
     */
    public function get(Identity $id): ?AggregateRoot
    {
        return $this->find($id);
    }
}

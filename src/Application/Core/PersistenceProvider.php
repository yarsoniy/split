<?php

namespace Company\Split\Application\Core;

/**
 * Interface PersistenceProvider
 * @package Company\Split\Application\Core
 */
interface PersistenceProvider
{
    /**
     * Flush changes to the persistence storage
     */
    public function flush();

    /**
     * Start a transaction
     */
    public function beginTransaction();

    /**
     * Commit the transaction
     */
    public function commit();

    /**
     * Rollback the transaction
     */
    public function rollback();
}

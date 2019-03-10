<?php

namespace Company\Split\Application\Person;

use Company\Split\Application\Core\ApplicationResult;

/**
 * Class CreatePersonResult
 * @package Company\Split\Application\Person
 */
class CreatePersonResult extends ApplicationResult
{
    /**
     * @var string
     */
    private $id;

    /**
     * @param string $id
     */
    public function setId(string $id)
    {
        $this->id = $id;
    }
}

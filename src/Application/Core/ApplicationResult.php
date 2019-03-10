<?php

namespace Company\Split\Application\Core;

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class ApplicationResult
 * @package Company\Split\Application\Core
 */
class ApplicationResult
{
    /**
     * @var ConstraintViolationListInterface
     */
    protected $errors;

    /**
     * ApplicationResult constructor.
     * @param ConstraintViolationListInterface $errors
     */
    public function __construct(ConstraintViolationListInterface $errors)
    {
        $this->errors = $errors;
    }

    /**
     * @return bool
     */
    public function hasErrors(): bool
    {
        return $this->errors->count() > 0;
    }

    /**
     * @return ConstraintViolationListInterface
     */
    public function getErrors(): ConstraintViolationListInterface
    {
        return $this->errors;
    }
}

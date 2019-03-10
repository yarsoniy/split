<?php

namespace Company\Split\Application\Person;

use Company\Split\Application\Core\PersistenceProvider;
use Company\Split\Domain\Person\ImpossibleNameException;
use Company\Split\Domain\Person\PersonRepository;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class CreatePersonHandler
 * @package Company\Split\Application\Person
 */
class CreatePersonHandler
{
    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var PersistenceProvider
     */
    private $persistence;

    /**
     * @var PersonRepository
     */
    private $repository;

    /**
     * CreatePersonHandler constructor.
     * @param ValidatorInterface $validator
     * @param PersistenceProvider $persistence
     * @param PersonRepository $repository
     */
    public function __construct(
        ValidatorInterface $validator,
        PersistenceProvider $persistence,
        PersonRepository $repository
    ) {
        $this->validator = $validator;
        $this->persistence = $persistence;
        $this->repository = $repository;
    }

    /**
     * @param CreatePersonRequest $request
     * @return CreatePersonResult
     */
    public function handle(CreatePersonRequest $request): CreatePersonResult
    {
        $result = new CreatePersonResult($this->validator->validate($request));
        if ($result->hasErrors()) {
            return $result;
        }

        try {
            $newId = $this->repository->getNewId();
//            $person = new Person($newId, $request->getName());
//            $this->repository->add($person);
//            $this->persistence->flush();

//            $result->setId($person->getId());
            return $result;
        } catch (ImpossibleNameException $e) {
//            $error = ...
//            $result->getErrors()->add($error);
        }

        return $result;
    }
}

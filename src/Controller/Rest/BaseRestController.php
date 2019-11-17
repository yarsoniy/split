<?php

namespace Company\Split\Controller\Rest;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class BaseRestController extends AbstractFOSRestController
{
    /** @var ValidatorInterface  */
    protected $validator;

    public function __construct(
        ValidatorInterface $validator
    ) {
        $this->validator = $validator;
    }

    /**
     * @param mixed|null $data
     * @return Response
     */
    protected function success($data = null)
    {
        $view = $this->view($data, Response::HTTP_OK);
        return $this->handleView($view);
    }

    /**
     * @param mixed|null $data
     * @return Response
     */
    protected function successCreated($data = null)
    {
        $view = $this->view($data, Response::HTTP_CREATED);
        return $this->handleView($view);
    }

    /**
     * @param int $httpCode
     * @param string $errorKey
     * @param string $message
     * @param string $propertyPath
     * @return Response
     */
    protected function error(int $httpCode, string $errorKey, string $message, string $propertyPath = '')
    {
        $error = [];
        $error['code'] = $httpCode;
        $error['key'] = $errorKey;
        $error['message'] = $message;
        $error['propertyPath'] = $propertyPath ?: null;

        $result = ['error' => $error];
        $view = $this->view($result, $httpCode);
        return $this->handleView($view);
    }

    protected function errorNotFound()
    {
        return $this->error(Response::HTTP_NOT_FOUND, 'not_found', 'Not found');
    }

    /**
     * @param $inputData
     * @return Response|null
     */
    protected function validateInput($inputData)
    {
        $validationErrors = $this->validator->validate($inputData);
        if (!$validationErrors->count()) {
            return null;
        }

        $error = [];
        $error['code'] = Response::HTTP_BAD_REQUEST;
        $error['key'] = "validation_error";
        $error['message'] = "Bad request";

        /** @var ConstraintViolationInterface $validationError */
        foreach ($validationErrors as $validationError) {
            $item = [];
            $item['message'] = $validationError->getMessage();
            $item['propertyPath'] = $validationError->getPropertyPath();

            $error['children'][] = $item;
        }

        $view = $this->view(['error' => $error], Response::HTTP_BAD_REQUEST);
        return $this->handleView($view);
    }
}

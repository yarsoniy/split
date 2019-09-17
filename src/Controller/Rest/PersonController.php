<?php

namespace Company\Split\Controller\Rest;

use Company\Split\Application\Auth\AuthProvider;
use Company\Split\Application\Auth\UsernameIsNotUnique;
use Company\Split\Application\Person\PersonService;
use Company\Split\Controller\Rest\Resource\PersonResourceInterest;
use Company\Split\Domain\Person\Person;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Company\Split\Controller\Rest\Resource\PersonResource;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PersonController
 * @package Company\Split\Controller\Rest
 * @SWG\Tag(name="person")
 */
class PersonController extends AbstractFOSRestController
{
    /** @var PersonService  */
    private $personService;

    /** @var AuthProvider  */
    private $auth;

    public function __construct(
        PersonService $personService,
        AuthProvider $auth
    ){
        $this->personService = $personService;
        $this->auth = $auth;
    }

    /**
     * @Rest\Post("people")
     * @Rest\View(serializerGroups={"Default","Created"})
     *
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     @Model(
     *      type=PersonResource::class,
     *      groups={"Default","Secure"}
     *     )
     * )
     * @SWG\Response(
     *     response=201,
     *     description="Created",
     *     @Model(
     *      type=PersonResource::class,
     *      groups={"Default","Created"}
     *     )
     * )
     * @SWG\Response(
     *     response=409,
     *     description="Conflict"
     * )
     *
     * @ParamConverter(
     *     "input",
     *     converter="fos_rest.request_body",
     *     options={"deserializationContext"={"groups"={"Default","Secure"}}}
     * )
     * @param PersonResource $input
     * @return Response
     */
    public function postAction(PersonResource $input)
    {
        try {
            $person = $this->personService->register(
                $input->username,
                $input->password,
                $input->fullName,
                $input->emailAddress
            );
        } catch (UsernameIsNotUnique $e) {
            $view = $this->view("Username already exists", Response::HTTP_CONFLICT);
            return $this->handleView($view);
        }

        $result = $this->prepareResource($person);

        $view = $this->view($result, Response::HTTP_CREATED);
        return $this->handleView($view);
    }

    /**
     * @Rest\Get("people/{id}")
     * @Rest\View(serializerGroups={"Default","Created"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Resource",
     *     @Model(
     *      type=PersonResource::class,
     *      groups={"Default","Created"}
     *     )
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Not found"
     * )
     *
     * @param $id
     * @return View
     */
    public function getAction($id)
    {
        $person = $this->personService->find($id);
        if (!$person) {
            return $this->view("Person not found", Response::HTTP_NOT_FOUND);
        }

        $result = $this->prepareResource($person);
        return $this->view($result, Response::HTTP_OK);
    }

    /**
     * @Rest\Get("people")
     * @Rest\View(serializerGroups={"Default","Created"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Collection of resources",
     *     @SWG\Schema(
     *      type="array",
     *      @SWG\Items(
     *          ref=@Model(
     *              type=PersonResource::class,
     *              groups={"Default","Created"}
     *          )
     *      )
     *     )
     * )
     *
     * @return View
     */
    public function getListAction()
    {
        $result = [];
        foreach ($this->personService->findAll() as $person) {
            $result[] = $this->prepareResource($person);
        }

        return $this->view($result, Response::HTTP_OK);
    }

    private function prepareResource(Person $person): PersonResource
    {
        $interest = new PersonResourceInterest();
        $result = $interest->enquire($person);
        $result->username = $this->auth->getUsername($person->getId());

        return $result;
    }
}

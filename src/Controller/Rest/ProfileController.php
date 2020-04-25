<?php

namespace Company\Split\Controller\Rest;

use Company\Split\Application\Auth\AuthProvider;
use Company\Split\Application\Auth\UsernameIsNotUnique;
use Company\Split\Application\Person\PersonAppService;
use Company\Split\Controller\Rest\Resource\ProfileMaker;
use Company\Split\Controller\Rest\Resource\ProfileResource;
use Company\Split\Domain\Core\EventDispatcherFacade;
use Company\Split\Domain\Person\EmailOccupiedException;
use Company\Split\Domain\Person\Person;
use Company\Split\Domain\Person\PersonCreatedEvent;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @package Company\Split\Controller\Rest
 * @SWG\Tag(name="profile")
 */
class ProfileController extends BaseRestController
{
    /** @var PersonAppService  */
    private $personService;

    /** @var AuthProvider  */
    private $auth;

    public function __construct(
        ValidatorInterface $validator,
        PersonAppService $personService,
        AuthProvider $auth
    ){
        parent::__construct($validator);
        $this->personService = $personService;
        $this->auth = $auth;
    }

    /**
     * @Rest\Post("profiles")
     * @Rest\View(serializerGroups={"Default","Created"})
     *
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     @Model(
     *      type=ProfileResource::class,
     *      groups={"Default","Secure"}
     *     )
     * )
     * @SWG\Response(
     *     response=201,
     *     description="Created",
     *     @Model(
     *      type=ProfileResource::class,
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
     * @param ProfileResource $input
     * @return Response
     */
    public function postAction(ProfileResource $input)
    {
        if ($validationResult = $this->validateInput($input)) {
            return $validationResult;
        }

        try {
            $person = $this->personService->register(
                $input->username,
                $input->password,
                $input->fullName,
                $input->emailAddress
            );
        } catch (UsernameIsNotUnique $e) {
            $msg = "Username already exists";
            return $this->error(Response::HTTP_CONFLICT, "username_is_not_unique", $msg, "username");
        } catch (EmailOccupiedException $e) {
            $msg = "User with the same email already exists";
            return $this->error(Response::HTTP_CONFLICT, "email_is_occupied", $msg, "emailAddress");
        }

        $result = $this->prepareResource($person);
        return $this->successCreated($result);
    }

    /**
     * @Rest\Get("profiles/{id}")
     * @Rest\View(serializerGroups={"Default","Created"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Resource",
     *     @Model(
     *      type=ProfileResource::class,
     *      groups={"Default","Created"}
     *     )
     * )
     * @SWG\Response(
     *     response=404,
     *     description="Not found"
     * )
     *
     * @param $id
     * @return Response
     */
    public function getAction($id)
    {
        $person = $this->personService->find($id);
        if (!$person) {
            return $this->errorNotFound();
        }

        $result = $this->prepareResource($person);
        return $this->success($result);
    }

    /**
     * @Rest\Get("profiles")
     * @Rest\View(serializerGroups={"Default","Created"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Collection of resources",
     *     @SWG\Schema(
     *      type="array",
     *      @SWG\Items(
     *          ref=@Model(
     *              type=ProfileResource::class,
     *              groups={"Default","Created"}
     *          )
     *      )
     *     )
     * )
     *
     * @return Response
     */
    public function getListAction()
    {
        $result = [];
        foreach ($this->personService->findAll() as $person) {
            $result[] = $this->prepareResource($person);
        }
        return $this->success($result);
    }

    private function prepareResource(Person $person): ProfileResource
    {
        $maker = new ProfileMaker();
        $profile = $maker->makeFromPerson($person);
        $profile->username = $this->auth->getUsername($person->getId());

        return $profile;
    }
}

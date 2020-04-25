<?php

namespace Company\Split\Controller\Rest;

use Company\Split\Application\Group\GroupAppService;
use Company\Split\Controller\Rest\Resource\GroupResource;
use Company\Split\Domain\Group\Group;
use FOS\RestBundle\Controller\Annotations as Rest;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @package Company\Split\Controller\Rest
 * @SWG\Tag(name="group")
 */
class GroupController extends BaseRestController
{
    /** @var GroupAppService  */
    private $groupService;

    public function __construct(
        ValidatorInterface $validator,
        GroupAppService $groupService
    ){
        parent::__construct($validator);
        $this->groupService = $groupService;
    }

    /**
     * @Rest\Post("groups")
     * @Rest\View(serializerGroups={"Default","Created"})
     *
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     @Model(
     *      type=GroupResource::class,
     *      groups={"Default"}
     *     )
     * )
     * @SWG\Response(
     *     response=201,
     *     description="Created",
     *     @Model(
     *      type=GroupResource::class,
     *      groups={"Default","Created"}
     *     )
     * )
     *
     * @ParamConverter(
     *     "input",
     *     converter="fos_rest.request_body",
     *     options={"deserializationContext"={"groups"={"Default"}}}
     * )
     * @param GroupResource $input
     * @return Response
     */
    public function postAction(GroupResource $input)
    {
        if ($validationResult = $this->validateInput($input)) {
            return $validationResult;
        }

        $group = $this->groupService->create($input->name);
        $result = $this->prepareResource($group);

        return $this->successCreated($result);
    }

    /**
     * @Rest\Get("groups/{id}")
     * @Rest\View(serializerGroups={"Default","Created"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Resource",
     *     @Model(
     *      type=GroupResource::class,
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
        $group = $this->groupService->find($id);
        if (!$group) {
            return $this->errorNotFound();
        }

        $result = $this->prepareResource($group);
        return $this->success($result);
    }

    /**
     * @Rest\Get("groups")
     * @Rest\View(serializerGroups={"Default","Created"})
     *
     * @SWG\Response(
     *     response=200,
     *     description="Collection of resources",
     *     @SWG\Schema(
     *      type="array",
     *      @SWG\Items(
     *          ref=@Model(
     *              type=GroupResource::class,
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
        foreach ($this->groupService->findAll() as $item) {
            $result[] = $this->prepareResource($item);
        }

        return $this->success($result);
    }

    private function prepareResource(Group $group): GroupResource
    {
        $resource = new GroupResource();
        $groupDTO = $group->toDTO();

        $resource->id = (string)$groupDTO->id;
        $resource->name = $groupDTO->name;
        $resource->whenCreated = $groupDTO->whenCreated;

        return $resource;
    }
}

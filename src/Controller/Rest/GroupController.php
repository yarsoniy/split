<?php

namespace Company\Split\Controller\Rest;

use Company\Split\Application\Group\GroupService;
use Company\Split\Controller\Rest\Resource\GroupResource;
use Company\Split\Controller\Rest\Resource\GroupResourceMaker;
use Company\Split\Domain\Group\Group;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;

/**
 * @package Company\Split\Controller\Rest
 * @SWG\Tag(name="group")
 */
class GroupController extends AbstractFOSRestController
{
    /** @var GroupService  */
    private $groupService;

    public function __construct(
        GroupService $groupService
    ){
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

        $group = $this->groupService->create($input->name);
        $result = $this->prepareResource($group);

        $view = $this->view($result, Response::HTTP_CREATED);
        return $this->handleView($view);
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
     * @return View
     */
    public function getAction($id)
    {
        $group = $this->groupService->find($id);
        if (!$group) {
            return $this->view("Resource not found", Response::HTTP_NOT_FOUND);
        }

        $result = $this->prepareResource($group);
        return $this->view($result, Response::HTTP_OK);
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
     * @return View
     */
    public function getListAction()
    {
        $result = [];
        foreach ($this->groupService->findAll() as $item) {
            $result[] = $this->prepareResource($item);
        }

        return $this->view($result, Response::HTTP_OK);
    }

    private function prepareResource(Group $object): GroupResource
    {
        $maker = new GroupResourceMaker();
        $resource = $maker->makeFromGroup($object);
        return $resource;
    }
}

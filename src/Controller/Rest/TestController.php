<?php

namespace Company\Split\Controller\Rest;

use Company\Split\Controller\Rest\Resource\Animal;
use Company\Split\Controller\Rest\Resource\Test;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class TestController extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/tests")
     * @SWG\Response(
     *     response=200,
     *     description="Collection of test object",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=Test::class))
     *     )
     * )
     * @return Response
     */
    public function getTestsAction()
    {
        $result = [];

        $test1 = new Test();
        $test1->setName('First');
        $test1->setAge(123);

        $test2 = new Test();
        $test2->setName('Second');
        $test2->setAge(456);

        $result[] = $test1;
        $result[] = $test2;

        $view = $this->view($result, Response::HTTP_OK);
        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/tests/{name}")
     * @SWG\Response(
     *     response=200,
     *     description="One test object",
     *     @Model(type=Test::class)
     * )
     * @param string $name
     * @return Response
     */
    public function getTestAction(string $name)
    {
        $object = new Test();
        $object->setName($name);
        $object->setAge(777);

        $a = new Animal('Cats', 'White', 4);
        $object->setAnimal($a);

        $view = $this->view($object, Response::HTTP_OK);
        return $this->handleView($view);
    }

    /**
     * @Rest\Post("/tests")
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     @Model(type=Test::class)
     * )
     * @SWG\Response(
     *     response=201,
     *     description="Created object",
     *     @Model(type=Test::class)
     * )
     * @ParamConverter("test", converter="fos_rest.request_body")
     * @param Test $test
     * @return Response
     */
    public function postTestAction(Test $test)
    {
        $debug = true;

        $view = $this->view($test, Response::HTTP_CREATED);
        return $this->handleView($view);
    }

    /**
     * @Rest\Put("/tests/{name}")
     * @ParamConverter("newTest", converter="fos_rest.request_body")
     * @param string $name
     * @param Test $newTest
     * @return Response
     */
    public function putTestAction(string $name, Test $newTest)
    {
        $test = $newTest;
        $test->setName($name);

        $view = $this->view($test, Response::HTTP_OK);
        return $this->handleView($view);
    }
}

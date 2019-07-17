<?php

namespace Company\Split\Controller\Rest;

use Company\Split\Controller\Rest\DTO\TestDTO;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;

class TestController extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/test")
     * @return Response
     */
    public function getTestAction()
    {
        $data = [
            'aaa' => 'AAA',
            'bbb' => 'BBB',
        ];

        $view = $this->view($data, Response::HTTP_OK);
        return $this->handleView($view);
    }

    /**
     * @Rest\Post("/test")
     * @ParamConverter("testDTO", converter="fos_rest.request_body")
     * @param TestDTO $testDTO
     * @return Response
     */
    public function postTestAction(TestDTO $testDTO)
    {
        $debug = true;

        $view = $this->view($testDTO, Response::HTTP_OK);
        return $this->handleView($view);
    }
}

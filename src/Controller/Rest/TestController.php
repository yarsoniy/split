<?php

namespace Company\Split\Controller\Rest;

use FOS\RestBundle\Controller\AbstractFOSRestController;
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
}

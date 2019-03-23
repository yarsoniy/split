<?php

namespace Company\Split\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/{frontEndRouting}", requirements={"frontEndRouting"="^(?!api|_(profiler|wdt)).*"})
     * @return Response
     */
    public function index()
    {
        return $this->render("base.html.twig");
    }
}
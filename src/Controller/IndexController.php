<?php
/**
 * Created by PhpStorm.
 * User: yarsoniy
 * Date: 24.02.19
 * Time: 13:57
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    /**
     * @Route("/")
     * @return Response
     * @throws \Exception
     */
    public function index()
    {
        //test

        $number = random_int(0, 100);

        return $this->render("index/index.html.twig", [
            'number' => $number,
        ]);
    }

    /**
     * @Route("/hello/{name<\d+>}/{surname}", name="hello")
     * @param $name
     * @param $surname
     * @return Response
     */
    public function hello($name, $surname)
    {
        //test

        $url = $this->generateUrl("hello", [
            'name' => $name,
            'surname' => "digits",
            'qoqoqo' => 'wowowo',
        ]);

        return $this->render("index/hello.html.twig", [
            'name' => $name,
            'surname' => $surname,
            'url' => $url,
        ]);
    }
}
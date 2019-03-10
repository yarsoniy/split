<?php
/**
 * Created by PhpStorm.
 * User: yarsoniy
 * Date: 24.02.19
 * Time: 13:57
 */

namespace Company\Split\Controller\SPA;

use Company\Split\Application\Person\CreatePersonHandler;
use Company\Split\Application\Person\CreatePersonRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    /**
     * @Route("/")
     *
     * @param CreatePersonHandler $handler
     * @return Response
     * @throws \Exception
     */
    public function index(CreatePersonHandler $handler) {
        $name = 'Chuck Norris';

        $appRequest = new CreatePersonRequest($name);
        $result = $handler->handle($appRequest);
        if (!$result->hasErrors()) {
            //...
        }

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
    public function hello($name, $surname, Request $request)
    {
        //test

        $this->createFormBuilder()
            ->add('name');

        if ($name == '404') {
            throw $this->createNotFoundException("Nooot foooound");
        }

        $people = [
            ['name' => 'Ivan', 'surname' => 'Ivanov'],
            ['name' => 'Boris', 'surname' => 'Borisov'],
        ];

        return $this->render("index/hello.html.twig", [
            'name' => $name,
            'surname' => $surname,
            'people' => $people,
        ]);
    }
}
<?php

namespace App\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    /*
     *
     * render main page
     * TODO: ad something to show off, like 5 newest ads, or some simple welcome message with functionality of an app
     *
     */

    #[Route(
        '/main',
        name: 'main_index',
        methods: 'get'
    )]
    public function index(): Response
    {
        return $this->render(
          'main/index.html.twig'
        );
    }
}

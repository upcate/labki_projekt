<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class TestController extends AbstractController
{
    #[Route(
        '/test',
        name: 'admin_test'
    )]
    public function index(Request $request): Response
    {
        return $this->render(
          'test/index.html.twig'
        );
    }
}
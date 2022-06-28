<?php

/**
 * AdminController.
 */

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController.
 */
#[Route('/admin')]
class AdminController extends AbstractController
{
    /**
     * Show admin panel action.
     *
     * @param Request $request
     *
     * @return Response
     */
    #[Route(
        '/panel',
        name: 'admin_panel',
        methods: 'get',
    )
    ]
    #[IsGranted('ROLE_ADMIN')]
    public function panel(Request $request): Response
    {
        return $this->render(
            'admin/panel.html.twig'
        );
    }
}

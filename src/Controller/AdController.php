<?php
/**
 * Task controller.
 */

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TaskController.
 */
#[Route('/ad')]
class AdController extends AbstractController
{

    #[Route(
        name: 'ad_index',
        methods: 'get'
    )]
    public function index(AdRepository $adRepository): Response
    {
        $ads = $adRepository->findAll();

        return $this->render(
            'ad/index.html.twig',
            ['ads' => $ads]
        );
    }

    #[Route(
        '/{id}',
        name: 'ad_show',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'get',
    )]
    public function show(Ad $ad): Response
    {
        return $this->render(
            'ad/show.html.twig',
            ['ad' => $ad]
        );
    }
}

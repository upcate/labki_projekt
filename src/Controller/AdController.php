<?php
/**
 * Task controller.
 */

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
use App\Service\AdService;
use App\Service\AdServiceInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class TaskController.
 */
#[Route('/ad')]
class AdController extends AbstractController
{

    private AdServiceInterface $adService;

    public function __construct(AdServiceInterface $adService)
    {
        $this->adService = $adService;
    }

    #[Route(
        name: 'ad_index',
        methods: 'get'
    )]
    public function index(Request $request): Response
    {

        $pagination = $this->adService->getPaginatedList(
          $request->query->getInt('page', 1)
        );

        return $this->render('ad/index.html.twig', ['pagination' => $pagination]);
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

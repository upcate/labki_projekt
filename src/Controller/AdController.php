<?php
/**
 * Task controller.
 */

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
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

    #[Route(
        name: 'ad_index',
        methods: 'get'
    )]
    public function index(Request $request, AdRepository $adRepository, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $adRepository->queryAll(),
            $request->query->getInt('page', 1),
            AdRepository::PAGINATOR_ITEMS_PER_PAGE
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

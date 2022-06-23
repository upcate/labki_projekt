<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\Type\AdType;
use App\Service\AdServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;


#[Route('/ad')]
class AdController extends AbstractController
{

    private AdServiceInterface $adService;
    private TranslatorInterface $translator;

    public function __construct(AdServiceInterface $adService, TranslatorInterface $translator)
    {
        $this->adService = $adService;
        $this->translator = $translator;
    }


    #[Route(
        name: 'ad_index',
        methods: 'get'
    )]
    public function index(Request $request): Response
    {
        $filters = $this->getFilters($request);
        $pagination = $this->adService->getPaginatedList(
            $request->query->getInt('page', 1),
            $filters
        );

        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->render('ad/admin.index.html.twig', ['pagination' => $pagination]);
        } else {
            return $this->render('ad/index.html.twig', ['pagination' => $pagination]);
        }
    }


    public function getFilters(Request $request): array
    {
        $filters = [];
        $filters['adCategory_id'] = $request->query->getInt('filters_adCategory_id');

        return $filters;
    }


    #[Route(
        '/toAccept',
        name: 'accept_index',
        methods: 'get'
    )]
    #[IsGranted('ROLE_ADMIN')]
    public function indexToAccept(Request $request): Response
    {
        $pagination = $this->adService->getPaginatedAcceptList(
            $request->query->getInt('page', 1)
        );

        return $this->render('ad/accept.index.html.twig', ['pagination' => $pagination]);
    }


    #[Route(
        '/{id}/accept',
        name: 'ad_accept',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET|PUT',
    )]
    #[IsGranted('ROLE_ADMIN')]
    public function acceptAd(Request $request,Ad $ad): Response
    {
        $form = $this->createForm(FormType::class, $ad, [
                'method'=>'PUT',
                'action'=>$this->generateUrl('ad_accept',['id'=>$ad->getId()]),
            ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->adService->makeVisible($ad);

            $this->addFlash(
                'success',
                $this->translator->trans('message.accepted_successfully')
            );

            return $this->redirectToRoute('accept_index');
        }

        return $this->render(
          '/ad/accept.html.twig',
          [
              'ad' => $ad,
              'form' => $form->createView(),
          ]
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


    #[Route(
        '/create',
        name: 'ad_create',
        methods: 'get|post'
    )]
    public function create(Request $request): Response
    {

        $ad = new Ad();
        $form = $this->createForm(AdType::class, $ad, ['action' => $this->generateUrl('ad_create'), ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($this->isGranted('ROLE_ADMIN')) {
                $this->adService->saveOnCreateAdm($ad);
            } else {
                $this->adService->saveOnCreateUs($ad);
            }

            $this->addFlash(
                'success',
                $this->translator->trans('message.created_successfully')
            );

            return $this->redirectToRoute('ad_index');
        }

        return $this->render(
          'ad/create.html.twig',
          [
              'form' => $form->createView(),
          ]);
    }


    #[Route(
        '/{id}/edit',
        name: 'ad_edit',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET|PUT'
    )]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, Ad $ad): Response
    {
        $form = $this->createForm(AdType::class, $ad, [
            'method' => 'PUT',
            'action' => $this->generateUrl('ad_edit', ['id' => $ad->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->adService->save($ad);

            $this->addFlash(
                'success',
                $this->translator->trans('message.edited_successfully')
            );

            return $this->redirectToRoute('ad_index');
        }

        return $this->render('ad/edit.html.twig', [
            'form' => $form->createView(),
            'ad' => $ad,
        ]);
    }


    #[Route(
        '/{id}/delete',
        name: 'ad_delete',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET|DELETE'
    )]
    #[IsGranted('ROLE_ADMIN')]
    public function delete(Request $request, Ad $ad): Response
    {
        $form = $this->createForm(FormType::class, $ad, [
            'method' => 'DELETE',
            'action' => $this->generateUrl('ad_delete', ['id' => $ad->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->adService->delete($ad);

            $this->addFlash(
                'success',
                $this->translator->trans('message.deleted_successfully')
            );

            return $this->redirectToRoute('ad_index');
        }

        return $this->render('ad/delete.html.twig', [
            'form' => $form->createView(),
            'ad' => $ad,
        ]);
    }


    #[Route(
        '/{id}/accept/delete',
        name: 'accept_delete',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET|DELETE'
    )]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteToAccept(Request $request, Ad $ad): Response
    {
        $form = $this->createForm(FormType::class, $ad, [
            'method' => 'DELETE',
            'action' => $this->generateUrl('accept_delete', ['id' => $ad->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->adService->delete($ad);

            $this->addFlash(
                'success',
                $this->translator->trans('message.deleted_successfully')
            );

            return $this->redirectToRoute('accept_index');
        }

        return $this->render('ad/delete.accept.html.twig', [
            'form' => $form->createView(),
            'ad' => $ad,
        ]);
    }

}

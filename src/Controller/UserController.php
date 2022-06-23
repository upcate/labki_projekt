<?php

namespace App\Controller;



use App\Entity\User;
use App\Form\Type\UserType;
use App\Service\UserServiceInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/admin')]
class UserController extends AbstractController
{

    private UserServiceInterface $userService;
    private TranslatorInterface $translator;

    public function __construct(UserServiceInterface $userService, TranslatorInterface $translator)
    {
        $this->userService = $userService;
        $this->translator = $translator;
    }


    #[Route(
        '/{id}/edit',
        name: 'user_edit',
        requirements: ['id' => '[1-9]\d*'],
        methods: 'GET|PUT',
    )]
    #[IsGranted('ROLE_ADMIN')]
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user, [
            'method' => 'PUT',
            'action' => $this->generateUrl('user_edit', ['id'=>$user->getId()]),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->userService->save($user);

            $this->addFlash(
                'success',
                $this->translator->trans('message.changed_successfully')
            );

            return $this->redirectToRoute('admin_panel');
        }

        return $this->render(
          'admin/edit.html.twig',
          [
              'form' => $form->createView(),
              'user' => $user,
          ]
        );
    }


}
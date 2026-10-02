<?php

namespace App\Controller\users;

// Import de l'entité User
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Twig\Environment;

// Import du formulaire d'édition
// Import du repository pour interagir avec la base de données
// Import du composant Security pour récupérer l'utilisateur connecté
// Import de la factory pour créer des formulaires
// Import pour les redirections
// Import pour gérer la requête HTTP
// Import pour créer des réponses HTTP
// Import pour déclarer cette classe comme contrôleur
// Import pour hasher le mot de passe
// Import pour définir la route
// Import de l'interface router pour générer des URLs
// Import pour restreindre l'accès par rôle
// Import du moteur de template Twig

#[Route('/edit', name: 'app_edit', methods: ['GET', 'POST'])]

#[AsController]

#[IsGranted('ROLE_USER')]

final class EditUserController
{

    public function __invoke(
        Security $security,
        Request $request,
        Environment $twig,
        FormFactoryInterface $formFactory,
        UserPasswordHasherInterface $passwordHasher,
        UserRepository $repository,
        RouterInterface $router
    ): Response
    {

        $user = $security->getUser();



        if (!$user instanceof User) {
            return new Response('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }


        $form = $formFactory->create(UserType::class, $user);


        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {


            $user = $form->getData();


            $password = $form->get('password')->getData();


            if ($password) {
                $user->setPassword($passwordHasher->hashPassword($user, $password));
            }


            $repository->persistAndSave($user);


            return new RedirectResponse($router->generate('app_home'));
        }



        return new Response($twig->render('user/edit.html.twig', [
            'form' => $form->createView(),
        ]));
    }
}

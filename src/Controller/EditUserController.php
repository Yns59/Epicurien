<?php

namespace App\Controller;

// Import de l'entité User
use App\Entity\User;
// Import du formulaire d'édition
use App\Form\UserType;
// Import du repository pour interagir avec la base de données
use App\Repository\UserRepository;
// Import du composant Security pour récupérer l'utilisateur connecté
use Symfony\Bundle\SecurityBundle\Security;
// Import de la factory pour créer des formulaires
use Symfony\Component\Form\FormFactoryInterface;
// Import pour les redirections
use Symfony\Component\HttpFoundation\RedirectResponse;
// Import pour gérer la requête HTTP
use Symfony\Component\HttpFoundation\Request;
// Import pour créer des réponses HTTP
use Symfony\Component\HttpFoundation\Response;
// Import pour déclarer cette classe comme contrôleur
use Symfony\Component\HttpKernel\Attribute\AsController;
// Import pour hasher le mot de passe
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
// Import pour définir la route
use Symfony\Component\Routing\Attribute\Route;
// Import de l'interface router pour générer des URLs
use Symfony\Component\Routing\RouterInterface;
// Import pour restreindre l'accès par rôle
use Symfony\Component\Security\Http\Attribute\IsGranted;
// Import du moteur de template Twig
use Twig\Environment;

#[Route('/edit', name: 'app_edit', methods: ['GET', 'POST'])]
// Déclare cette classe comme un contrôleur Symfony
#[AsController]
// Bloque l'accès aux utilisateurs non connectés ou sans ROLE_USER
#[IsGranted('ROLE_USER')]
// Classe finale : ne peut pas être étendue
final class EditUserController
{
    // Définit la route, le nom et les méthodes HTTP acceptées


    // __invoke est appelé automatiquement par Symfony quand la route est atteinte
        // Toutes les dépendances sont injectées automatiquement en paramètres
    public function __invoke(
        Security $security,                          // Pour récupérer l'user connecté
        Request $request,                            // La requête HTTP entrante
        Environment $twig,                           // Pour rendre les templates
        FormFactoryInterface $formFactory,           // Pour créer le formulaire
        UserPasswordHasherInterface $passwordHasher, // Pour hasher le mot de passe
        UserRepository $repository,                  // Pour sauvegarder en BDD
        RouterInterface $router                      // Pour générer les URLs
    ): Response
    {
        // Récupère l'utilisateur connecté depuis la session
        $user = $security->getUser();

        // Vérifie que l'utilisateur est bien une instance de User
        // Si non (null ou autre), retourne une erreur 401
        if (!$user instanceof User) {
            return new Response('Unauthorized', Response::HTTP_UNAUTHORIZED);
        }

        // Crée le formulaire d'édition en le liant à l'objet $user
        $form = $formFactory->create(UserType::class, $user);

        // Analyse la requête HTTP et remplit le formulaire avec les données POST
        $form->handleRequest($request);

        // Vérifie que le formulaire a été soumis ET que les données sont valides
        if ($form->isSubmitted() && $form->isValid()) {

            // Récupère l'objet $user mis à jour avec les données du formulaire
            $user = $form->getData();

            // Récupère le mot de passe saisi dans le formulaire
            $password = $form->get('password')->getData();

            // Hash le mot de passe uniquement si un nouveau a été saisi
            if ($password) {
                $user->setPassword($passwordHasher->hashPassword($user, $password));
            }

            // Sauvegarde l'utilisateur en base de données
            $repository->persistAndSave($user);

            // Redirige vers la page d'accueil après la sauvegarde
            return new RedirectResponse($router->generate('app_home'));
        }

        // Affiche le formulaire (GET ou formulaire invalide)
        // Retourne une réponse 200 avec le template Twig
        return new Response($twig->render('user/edit.html.twig', [
            'form' => $form->createView(), // Passe le formulaire au template
        ]));
    }
}

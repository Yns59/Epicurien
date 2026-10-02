<?php

namespace App\Controller\users;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    #[Route('/register', name: 'app_register', methods: ['GET', 'POST'])]
    public function __invoke(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        UserRepository $userRepository
    ): Response {


        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $existinguser= $userRepository->findBy(['mail' => $user->getmail(),
                'number_phone'=>$user->getNumberPhone()]);
            if($existinguser){
                $this->addFlash('error', 'Cet email ou le numero et deja associer.');
                return $this->redirectToRoute('app_register');
                    }
            $user->setRoles(['ROLE_USER']);

            // Hachage du mot de passe
            $plainPassword = $user->getPassword();
            $hashedPassword = $passwordHasher->hashPassword($user, $plainPassword);
            $user->setPassword($hashedPassword);


            $userRepository->save($user, true);

            $this->addFlash('success', 'Votre compte a bien été créé !');

            return $this->redirectToRoute('app_register');
        }

        return $this->render('user/register.html.twig', [
            'registrationForm' => $form->createView(),
            'error' => null
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation_submit', methods: ['POST'])]
    public function index(Request $request): Response
    {
        $prenom   = $request->request->get('prenom');
        $nom      = $request->request->get('nom');
        $email    = $request->request->get('email');
        $telephone = $request->request->get('telephone');
        $date     = $request->request->get('date');
        $heure    = $request->request->get('heure');
        $couverts = $request->request->get('couverts');
        $message  = $request->request->get('message');

        // Ici : envoyer un mail, sauvegarder en BDD, etc.

        $this->addFlash('success', 'Votre réservation a bien été envoyée !');

        return $this->redirectToRoute('app_home');
    }
}

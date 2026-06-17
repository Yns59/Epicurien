<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route("/", name: "app_home", methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route("/menu", name: "app_menu", methods: ['GET'])]
    public function menu(): Response
    {
        return $this->redirectToRoute('app_home', ['_fragment' => 'menu']);
    }

    #[Route("/reservation", name: "app_reservation", methods: ['GET'])]
    public function reservation(): Response
    {
        return $this->redirectToRoute('app_home', ['_fragment' => 'reservation']);
    }

    #[Route("/galerie", name: "app_galerie", methods: ['GET'])]
    public function galerie(): Response
    {
        return $this->redirectToRoute('app_home', ['_fragment' => 'galerie']);
    }
}

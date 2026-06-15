<?php

namespace App\Controller;

use http\Env\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Router;
use Twig\Environment;


class HomeController
{
    #[Route("/homepage", name: "homepage", methods: ['GET'])]
    public function __invoke(Environment $twig): Response
    {

        return new Response($twig->render('base.html.twig'));
    }

    #[Route("/home", name: "home", methods: ['GET'])]
    public function home(Environment $twig):Response
    {
        return new Response($twig->render('home.html.twig'));
    }
    #[Route("/menu", name: "menu", methods: ['GET'])]
    public function menu(Environment $twig):Response
    {
        return new Response($twig->render('menu.html.twig'));
    }

    #[Route("//reservation", name: "reservation", methods: ['GET'])]
    public function reservation(Environment $twig):Response
    {
        return new Response($twig->render('reservation.html.twig'));
    }

}

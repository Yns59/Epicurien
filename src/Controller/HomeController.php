<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\MenuRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route("/", name: "app_home", methods: ['GET','POST'])]
    public function index(ProductRepository $productRepository,MenuRepository $menuRepository): Response
    {
        $menu=$menuRepository->findAll();
    $product=$productRepository->findAll();
        $form = $this->createForm(ReservationType::class, new Reservation());
        return $this->render('home.html.twig',['products'=>$product,
            'form' => $form->createView(),
            'menu'=>$menu]);
    }

}

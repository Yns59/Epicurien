<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ProductRepository;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Router;



class ReservationController extends AbstractController
{
    #[Route("/reservation", name: 'app_reserve',methods: ['POST','GET'])]
    public function __invoke(ReservationRepository $repository,Request $request,EntityManagerInterface $manager,ProductRepository $productRepository){
        $reservation= new Reservation();
        $form=$this->createForm(ReservationType::class,$reservation);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $existing=$repository->findOneByUserAndDate($this->getUser(),$reservation->getDate());
            if ($existing) {
                $this->addFlash('error', 'Vous avez déjà une réservation pour cette journée.');
                return $this->redirectToRoute('app_home');
            }

            $manager->persist($reservation);
            $manager->flush();
            $this->addFlash('succes','la reservation a bien etait prise en compte ');
            return $this->redirectToRoute('app_home',);

        }


        return $this->render('home.html.twig',[
            'form'=> $form->createView(),
            'products'=>$productRepository->findAll()
        ]);


    }

}

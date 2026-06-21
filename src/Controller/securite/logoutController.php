<?php


namespace App\Controller\securite;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
#[Route('/logout', name: 'app_logout')]
class logoutController
{
    public function __invoke(): Response
    {
        throw new \LogicException('Cette méthode est interceptée par le firewall avant d\'être exécutée.');
    }
}

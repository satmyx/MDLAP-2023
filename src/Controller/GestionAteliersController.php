<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionAteliersController extends AbstractController
{
    #[Route('/gestion/ateliers', name: 'app_gestion_ateliers')]
    public function index(): Response
    {
        
        
        return $this->render('gestion_ateliers/index.html.twig', [
            'controller_name' => 'GestionAteliersController',
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogHistoryController extends AbstractController
{
    #[Route('/loghistory', name: 'app_log_history')]
    public function index(): Response
    {
        return $this->render('log_history/index.html.twig', [
            'controller_name' => 'LogHistoryController',
        ]);
    }
}

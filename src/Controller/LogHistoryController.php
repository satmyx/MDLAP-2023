<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Log;

class LogHistoryController extends AbstractController
{
    #[Route('/loghistory', name: 'app_log_history')]
    public function index(EntityManagerInterface $manager): Response
    {
        $listeDesLogs = $manager->getRepository(Log::class)->findAll();
        
        return $this->render('log_history/index.html.twig', [
            'controller_name' => 'LogHistoryController',
            'listeDesLogs' => $listeDesLogs,
        ]);
    }
}

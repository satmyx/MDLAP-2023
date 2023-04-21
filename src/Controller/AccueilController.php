<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Atelier;
use App\Repository\AtelierRepository;
use App\Repository\ThemeRepository;
use App\Repository\VacationRepository;
use App\Repository\HotelRepository;
//use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

#[Route('/', name: 'Maison Des Ligues')]
class AccueilController extends AbstractController
{
    #[Route('/')]
    public function index(AtelierRepository $atelierRepo, ThemeRepository $themeRepo, VacationRepository $vacRepo,
            HotelRepository $hotelRepo, ManagerRegistry $doctrine): Response
    {
        $datecongres = 'uneDate';
        $ateliers= $atelierRepo->findAll(); //->findAll();
        $themes = $themeRepo->getThemeLibelleByAtelier();
        $vacation = $vacRepo->findAll();
        $hotels = $hotelRepo->findAll();
        
        
        return $this->render('accueil/index.html.twig', [
            'dateCongres' => $datecongres,
            'ateliers'=> $ateliers,
            'themes' => $themes,
            'vacations' => $vacation,
            'hotels' => $hotels,
        ]);
    }
}

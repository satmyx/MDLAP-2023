<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AtelierRepository;
use App\Repository\ThemeRepository;
use App\Repository\VacationRepository;
use App\Repository\HotelRepository;
//use Doctrine\ORM\EntityManagerInterface;
//use Doctrine\Persistence\ManagerRegistry;

#[Route('/', name: 'Maison Des Ligues')]
class AccueilController extends AbstractController
{
    #[Route('/')]
    public function index(AtelierRepository $atelierRepo, ThemeRepository $themeRepo, VacationRepository $vacRepo,
            HotelRepository $hotelRepo/*, ManagerRegitry $doctrine*/): Response
    {
        $datecongres = 'uneDate';
//        $ateliers = $doctrine->getRepository(Atelier::class)->findAteliers($doctrine);
//        $ateliers = $atelierRepo->findAll();
//        $ateliersNom = $ateliers->getLibelle();
//        $ateliersNbPlaces = $ateliers->getNbPlaces();
        $themes = $themeRepo->findAll();
        $vacation = $vacRepo->findAll();
        $hotels = $hotelRepo->findAll();
        
        
        return $this->render('accueil/index.html.twig', [
            'dateCongres' => $datecongres,
//            'ateliers'=> $ateliers,
//            'ateliersNom'=> $ateliersNom,
//            'ateliersPlaces'=> $ateliersNbPlaces,
            'themes' => $themes,
            'vacations' => $vacation,
            'hotels' => $hotels,
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AtelierRepository;
use App\Repository\ThemeRepository;
use App\Repository\VacationRepository;
use App\Repository\ChambreRepository;
use App\Repository\HotelRepository;
//use Doctrine\ORM\EntityManagerInterface;


#[Route('/', name: 'Maison Des Ligues')]
class AccueilController extends AbstractController
{
    #[Route('/')]
    public function index(AtelierRepository $atelierRepo, ThemeRepository $themeRepo, VacationRepository $vacRepo,
            ChambreRepository $chambreRepo, HotelRepository $hotelRepo): Response
    {
        $datecongres = 'uneDate';
        $ateliers = $atelierRepo->findAll();
        $themes = $themeRepo->findAll();
        $vacation = $vacRepo->findAll();
        $chambres = $chambreRepo->findAll();
        $hotels = $hotelRepo->findAll();
        
        
        return $this->render('accueil/index.html.twig', [
            'dateCongres' => $datecongres,
            'ateliers'=> $ateliers,
            'themes' => $themes,
            'vacations' => $vacation,
            'hotels' => $hotels,
            'chambres' => $chambres,
        ]);
    }
}

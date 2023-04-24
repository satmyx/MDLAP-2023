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
        $x = $atelierRepo->find(1) ;
        $listeDesThemes = array();
        $listeDesThemes2 = array();
        $datecongres = 'uneDate';
        $ateliers = $atelierRepo->findAll();
        foreach($ateliers as $atelier){
            //array_push($listeDesThemes, $atelier->getThemes());
//            $x = $atelierRepo->find($atelier->getId());
//            $x->getThemes();
            foreach($atelierRepo->find($atelier->getId()->getThemes()) as $key => $value){
                dd($x);
                array_push($listeDesThemes2, $value->getLibelle());
            }
        }
        
        dd($listeDesThemes2);
        

        foreach($themesAtelier as $key => $value){
            array_push($listeDesThemes,$value->getLibelle());
        }
        dd($listeDesThemes);
        //$themes = $themeRepo->findall();
        $themes = $themeRepo->findby(array('atelier'=>1));
        dd($themes);
        //$initAtelier = $ateliers->getThemes();
        
        
        
        
        
        foreach($ateliers as $key => $value){
            array_push($listeDesThemes,$value->getThemes());
            foreach($value->getThemes() as $test){
            }
        }
        foreach($listeDesThemes as $key => $value){
            dd($value->getThemes());
        }


        $relationAtelierTheme = array();
        foreach ($themes as $valueIdAtelier){
            $relationAtelierTheme = $valueIdAtelier->getAtelier()->getId();
            $libelles = $themeRepo->getThemeLibelleByAtelier($relationAtelierTheme);
            //dd($libelles);
        }
        $vacation = $vacRepo->findAll();
        $hotels = $hotelRepo->findAll();
        
        
        return $this->render('accueil/index.html.twig', [
            'dateCongres' => $datecongres,
            'ateliers'=> $ateliers,
            'themes' => $listeDesThemes,
            'vacations' => $vacation,
            'hotels' => $hotels,
        ]);
    }
}

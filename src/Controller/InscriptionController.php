<?php

namespace App\Controller;

use App\Entity\Inscription;
use App\Form\InscriptionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Service\CallApiService;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(EntityManagerInterface $manager, Request $request, CallApiService $api): Response
    {
        $newInscription = new Inscription();

        $form = $this->createForm(InscriptionType::class, $newInscription);

        $form->handleRequest($request);
        
        $listeliciencie = $api->getLicencies()['hydra:member'];
        
        dump($listeliciencie);


        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($newInscription);

            $manager->flush();

        }


        return $this->render('inscription/index.html.twig', [
            'form' => $form->createview(),
        ]);
    }
}

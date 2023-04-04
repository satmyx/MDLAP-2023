<?php

namespace App\Controller;

use DateTime;
use App\Entity\Inscription;
use App\Form\InscriptionType;
use App\Service\CallApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(EntityManagerInterface $manager, Request $request, CallApiService $api): Response
    {
        $newInscription = new Inscription();

        $form = $this->createForm(InscriptionType::class, $newInscription);

        $form->handleRequest($request);
        
        // Ne pas oublier de modif quand la features security est mise en place
        $licencie = $api->getLicencies(16890512079);
        
        $qualite = $api->getQualite($licencie[0]['idqualite']);

        if($form->isSubmitted() && $form->isValid()) {

            $newInscription->setDateInscription(new DateTime('now'));

            //$newInscription->setLicencie();

            $manager->persist($newInscription);

            $manager->flush();

            return $this->redirectToRoute('app_somewhere');
        }


        return $this->render('inscription/index.html.twig', [
            'form' => $form->createview(),
            'nomlicencie' => $licencie[0]['nom'],
            'prenomlicencie' => $licencie[0]['prenom'],
            'numerolicence' => $licencie[0]['numlicence'],
            'adresse1' => $licencie[0]['adresse1'],
            'cp' => $licencie[0]['cp'],
            'ville' => $licencie[0]['ville'],
            'tel' => $licencie[0]['tel'],
            'mail' => $licencie[0]['mail'],
            'qualite' => $qualite['libellequalite']
        ]);
    }
}

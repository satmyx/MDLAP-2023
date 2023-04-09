<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CallApiService;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ValidationInscriptionController extends AbstractController
{
    #[Route('/validation', name: 'app_validation_inscription')]
    public function index(CallApiService $api): Response
    {
        $licencie = $api->getLicencies($this->getUser()->getNumlicence());
        
        $qualite = $api->getQualite($licencie[0]['idqualite']);
        
        return $this->render('validation_inscription/index.html.twig', [
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

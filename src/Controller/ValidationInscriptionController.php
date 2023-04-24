<?php

namespace App\Controller;

use App\Entity\Etat;
use App\Service\CallApiService;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ValidationInscriptionController extends AbstractController
{
    #[Route('/validation', name: 'app_validation_inscription')]
    public function index(CallApiService $api): Response
    {

        $inscription = $this->getUser()->getInscription();

        $logementInscrit = $inscription->getLoger();

        $atelierInscrit = $inscription->getAtelierInscrit();

        $restaurationInscrit = $inscription->getRestaurer();

        $listeDesAteliers = array();

        $listeDesRestaurations = array();

        foreach ($atelierInscrit as $key => $value) {
            array_push($listeDesAteliers, $value->getLibelle());
        }
        foreach ($restaurationInscrit as $key => $value) {
            array_push($listeDesRestaurations, $value->getLibelle());
        }

        $prixTotal = 100+35*count($restaurationInscrit)+$logementInscrit->getTarifsNuites();

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
            'qualite' => $qualite['libellequalite'],
            'listeAteliers' => $listeDesAteliers,
            'logementInscrit' => $logementInscrit,
            'listeDesRestaurations' => $listeDesRestaurations,
            'prixTotal' => $prixTotal,
        ]);
    }

    #[Route('/validationetat', name: 'app_validation_inscription_etat')]
    public function validationInscription(MailerInterface $mailer, EntityManagerInterface $manager): Response
    {
        // Récupération des informations
        $inscription = $this->getUser()->getInscription();

        $logementInscrit = $inscription->getLoger();

        $atelierInscrit = $inscription->getAtelierInscrit();

        $restaurationInscrit = $inscription->getRestaurer();

        $listeDesAteliers = array();

        $listeDesRestaurations = array();

        // Passage vers l'état valider
        $etat = $manager->getRepository(Etat::class)->find(2);

        $inscription->setEtat($etat);

        foreach ($atelierInscrit as $key => $value) {
            array_push($listeDesAteliers, $value->getLibelle());
        }
        foreach ($restaurationInscrit as $key => $value) {
            array_push($listeDesRestaurations, $value->getLibelle());
        }

        $manager->flush();

        $prixTotal = 100+35*count($restaurationInscrit)+$logementInscrit->getTarifsNuites();
        
        $email = (new TemplatedEmail())
        ->from(new Address('mailer@mailer.de', 'mailer boot'))
        ->to($this->getUser()->getEmail())
        ->subject('Maison des ligues - Votre inscription a était valider')
        ->htmlTemplate('inscription/validation.html.twig')
        ->context([
            'prixTotal' => $prixTotal,
            'listeDesAteliers' => $listeDesAteliers,
            'listeDesRestaurations' => $listeDesRestaurations,
            'logementInscrit' => $logementInscrit,
        ]);

        $mailer->send($email);

        return $this->redirectToRoute('app_user');
    }
}

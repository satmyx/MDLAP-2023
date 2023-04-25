<?php

namespace App\Controller;

use DateTime;
use App\Entity\Etat;
use App\Entity\Inscription;
use App\Form\InscriptionType;
use App\Service\CallApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'app_inscription')]
    public function index(MailerInterface $mailer, EntityManagerInterface $manager, Request $request, CallApiService $api): Response
    {
        // Récupération des informations
        $newInscription = new Inscription();

        $form = $this->createForm(InscriptionType::class, $newInscription);

        $form->handleRequest($request);
        
        $licencie = $api->getLicencies($this->getUser()->getNumlicence());
        
        $qualite = $api->getQualite($licencie[0]['idqualite']);

        if($form->isSubmitted() && $form->isValid()) {

            $newInscription->setDateInscription(new DateTime('now'));

            $newInscription->setLicencie($this->getUser());

            $etat = $manager->getRepository(Etat::class)->find(1);

            $newInscription->setEtat($etat);

            $listeDesAteliers = array();
    
            $listeDesRestaurations = array();

            $validiteAteliers = array();

            // ID bénévole = 20
            if($licencie[0]['idqualite'] == 20) {
                $newInscription->setLoger(null);
            }

            // ID Animateur = 21
            if($licencie[0]['idqualite'] == 21) {
                $newInscription->setLoger(null);
            }
    
            foreach ($newInscription->getAtelierInscrit() as $key => $value) {
                array_push($listeDesAteliers, $value->getLibelle());
                // Récupération du nombre de places par ateliers.
                $nbplaces = $manager->getRepository(Inscription::class)->getNbAtelier($value->getId());
                // Vérification si un atelier a encore de la place.
                if($nbplaces[0]['nbplaces'] < $value->getNbplaces()) {
                    array_push($validiteAteliers, true);
                } else {
                    array_push($validiteAteliers, false);
                }
            }
            foreach ($newInscription->getRestaurer() as $key => $value) {
                array_push($listeDesRestaurations, $value->getLibelle());
            }


            if (in_array(false, $validiteAteliers)){
                $validite = false;
            } else {
                $validite = true;
            }

            // Récupération du prix si bénévoles et animateurs.
            if($licencie[0]['idqualite'] == 20) {
                $prixTotal = 0;
            } elseif($licencie[0]['idqualite'] == 21) {
                $prixTotal = 0;
            } else {
                $prixTotal = 100+35*count($newInscription->getRestaurer())+$newInscription->getLoger()->getTarifsNuites();
            }

            if ($validite == true ) {

                $email = (new TemplatedEmail())
                ->from(new Address('mailer@mailer.de', 'mailer boot'))
                ->to($this->getUser()->getEmail())
                ->subject('Maison des ligues - Attente de validation de votre inscription !')
                ->htmlTemplate('inscription/attente.html.twig')
                ->context([
                    'prixTotal' => $prixTotal,
                    'listeDesAteliers' => $listeDesAteliers,
                    'listeDesRestaurations' => $listeDesRestaurations,
                    'logementInscrit' => $newInscription->getLoger(),
                    'idqualite' => $licencie[0]['idqualite'],
                ]);
    
                $mailer->send($email);
    
                $this->getUser()->setInscription($newInscription);
    
                $manager->persist($newInscription);
    
                $manager->flush();
    
                return $this->redirectToRoute('app_accueil');

            } else {
                $this->addFlash('error', "L'un des ateliers est complet veuillez en choisir un autre");
            }

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
            'qualite' => $qualite['libellequalite'],
            'idqualite' => $licencie[0]['idqualite'],
        ]);
    }
}

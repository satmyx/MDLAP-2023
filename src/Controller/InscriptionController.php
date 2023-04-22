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

            $this->getUser()->setInscription($newInscription);

            $manager->persist($newInscription);

            $manager->flush();


            // Récupération des infos pour l'envoie du mail.

            $prixTotal = 100+35*count($newInscription->getRestaurer())+$newInscription->getLoger()->getTarifsNuites();
    
            $listeDesAteliers = array();
    
            $listeDesRestaurations = array();
    
            foreach ($newInscription->getAtelierInscrit() as $key => $value) {
                array_push($listeDesAteliers, $value->getLibelle());
            }
            foreach ($newInscription->getRestaurer() as $key => $value) {
                array_push($listeDesRestaurations, $value->getLibelle());
            }

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
            ]);

            $mailer->send($email);

            return $this->redirectToRoute('app_user');
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

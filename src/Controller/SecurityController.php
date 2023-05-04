<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Log;
use DateTime;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\CallApiService;

class SecurityController extends AbstractController {

    #[Route(path: '/login', name: 'app_login')]
    public function login(Request $request, EntityManagerInterface $manager, AuthenticationUtils $authenticationUtils, CallApiService $api): Response {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_accueil');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        $newErrorLog = new Log();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();
        
        $ip = "24.48.0.1";
        
        $paysIp = $api->getPays($ip);

        $newErrorLog->setDateHConnexion(new DateTime('now'));
        $newErrorLog->setIp($request->getClientIp());
        $newErrorLog->setPays($paysIp['countryCode']);
        $newErrorLog->setNumLicencie($lastUsername);
        $newErrorLog->setNavigateur($request->headers->get('User-Agent'));

        if ($error) {
            $newErrorLog->setEtatConnexion(0);
        } else {
            $newErrorLog->setEtatConnexion(1);
        }

        $manager->persist($newErrorLog);
        $manager->flush();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'app_logout')]
    public function logout(): void {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

}

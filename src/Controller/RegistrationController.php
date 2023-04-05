<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\AppAuthenticator;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use App\Service\CallApiService;

class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, UserAuthenticatorInterface $userAuthenticator, 
            AppAuthenticator $authenticator, EntityManagerInterface $entityManager, CallApiService $api): Response
    {
	if ($this->getUser()) {
            return $this->redirectToRoute('app_user');
	}

	$user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // TODO Appel du repository : UserRepository::VerifNumeroLicence($user);
            $entreeUtilisateurNumLicence = $user->getNumlicence();
            $appelApiNumLicence = $api->getLicencies($entreeUtilisateurNumLicence); // 16360514319, 16381117915, 16790322264 = numéros valides
            $numeroLicenceApiExiste = isset($appelApiNumLicence[0]['numlicence']);
            
            // $regex = 11 Chiffres où le premier n'est pas un 0
            $regex = '/^[1-9]\d{10}$/';
            
            if ($numeroLicenceApiExiste) {
                $numeroLicenceApi = $appelApiNumLicence[0]['numlicence'];
                $controleEntreeUtilisateur = (bool) preg_match($regex, $entreeUtilisateurNumLicence);
                $correspondanceEntreNumeros = ((int) $entreeUtilisateurNumLicence === $numeroLicenceApi);
            } else {
                $this->addFlash('test', 'Numéro invalide');
            }
            
            if (!($numeroLicenceApiExiste) || !($controleEntreeUtilisateur) || !($correspondanceEntreNumeros)) {
                $this->addFlash('test', 'Numéro invalide');
            }
            
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('mailer@mailer.de', 'mailer boot'))
                    ->to($user->getEmail())
                    ->subject('Maison des ligues - Confirmer votre email !')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );
            // do anything else you need here, like send an email

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $exception->getReason());

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_login');
    }
    
    #[Route('/logout', name:'app_logout')]
    public function logout() : void {}
    
}

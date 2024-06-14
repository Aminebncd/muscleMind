<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UpdateEmailType;
use App\Security\EmailVerifier;
use App\Form\UpdatePasswordType;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Security\AppAuthenticator;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3Validator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;


class RegistrationController extends AbstractController
{
    private EmailVerifier $emailVerifier;

    public function __construct(EmailVerifier $emailVerifier)
    {
        $this->emailVerifier = $emailVerifier;
    }

    // renders the registration page
    // this function is used to register a new user
    // it also sends an email to the user to verify his email
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, 
                            UserPasswordHasherInterface $userPasswordHasher, 
                            UserAuthenticatorInterface $userAuthenticator, 
                            AppAuthenticator $authenticator, 
                            Recaptcha3Validator $recaptcha3Validator,
                            EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {

            $score = $recaptcha3Validator->getLastResponse()->getScore();
            // dd($form['honeypot']->getData());
            
            // this is a honeypot field to prevent spam
            // since i added reCaptcha, i don't need this anymore
            // if ($form['honeypot']->getData() !== '') {
            //     // throw an error if the honeypot field is filled
            //     $this->addFlash('error', 'Bot detected.');
            //     return $this->redirectToRoute('app_register');           
            // }
            // dd($form->getData());
            $user->setScore(0);
            $user->setIsVerified(false);
            $user->setRoles(['ROLE_USER']);
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
            (new TemplatedEmail())
                ->from(new Address('admin@muscleMind.com', 'Registration Bot'))
                ->to($user->getEmail())
                ->subject('Please Confirm your Email')
                ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );

        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }


    // this function is used to update the user's email
    #[Route('/updateUserEmail/{id}', name: 'app_register_updateEmail')]
    public function updateUserEmail(Request $request, 
                            UserRepository $ur,
                            UserAuthenticatorInterface $userAuthenticator,
                            EntityManagerInterface $em,
                            User $user = null): Response
    {
        
        if (!$user) {
            return $this->redirectToRoute('app_home');
        }

        // just so i can pass it in the template
        $user;

        $form = $this->createForm(UpdateEmailType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            // dd($form->getData());
            $user->setIsVerified(false);
            $em->persist($user);
            $em->flush();

            // generate a signed url and email it to the user
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
            (new TemplatedEmail())
                ->from(new Address('admin@muscleMind.com', 'Registration Bot'))
                ->to($user->getEmail())
                ->subject('Please Confirm your Email')
                ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            return $userAuthenticator->authenticateUser(
                $user,
                $authenticator,
                $request
            );
        }
        
        return $this->render('registration/updateEmail.html.twig', [
            'user' => $user,
            'updateEmailForm' => $form,
        ]);

    }

    // this function is used to update the user's password
    // it's different from the reset password function
    // because the user must be logged in to update his password
    #[Route('/updateUserPassword/{id}', name: 'app_register_updatePassword')]
    public function updateUserPassword(Request $request, 
                            UserRepository $ur,
                            UserPasswordHasherInterface $passwordEncoder,
                            EntityManagerInterface $em,
                            User $user = null): Response
    {

        if (!$user) {
        return $this->redirectToRoute('app_home');
        }

        $form = $this->createForm(UpdatePasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // we initialize the old password to compare it with the new one in the form
            $oldPassword = $form->get('oldPassword')->getData();

            // if the old password is correct, we update the user's password
            if ($passwordEncoder->isPasswordValid($user, $oldPassword)) {
                $newPassword = $form->get('newPassword')->getData();
                $user->setPassword($passwordEncoder->hashPassword($user, $newPassword));
                $user->setIsVerified(false);
                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('app_logout');
            }
        }

        return $this->render('registration/updatePassword.html.twig', [
        'user' => $user,
        'updatePasswordForm' => $form,
        ]);
    }


    // this function is used to verify the user's email
    // it is called when the user clicks on the link sent to his email
    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

        return $this->redirectToRoute('app_home');
    }
}

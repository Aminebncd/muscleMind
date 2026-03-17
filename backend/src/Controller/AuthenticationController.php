<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Security\EmailVerifier;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

#[Route('/api/auth', name: 'api_auth_')]
class AuthenticationController extends AbstractController
{
    public function __construct(private EmailVerifier $emailVerifier)
    {
    }

    #[Route('/register', name: 'register', methods: ['POST'])]
    public function register(
        Request $request,
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        if (!$data) {
            return $this->json(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
        }

        // Validate required fields
        if (!isset($data['email'], $data['username'], $data['password'])) {
            return $this->json(['error' => 'Missing required fields: email, username, password'], Response::HTTP_BAD_REQUEST);
        }

        // TODO: Add reCAPTCHA validation when karser/recaptcha3-bundle is installed

        // Create user
        $user = new User();
        $user->setEmail($data['email']);
        $user->setUsername($data['username']);
        $user->setPassword($passwordHasher->hashPassword($user, $data['password']));
        $user->setRoles(['ROLE_USER']);
        $user->setScore(0);
        $user->setIsVerified(false);

        // Optional fields
        if (isset($data['dateOfBirth'])) {
            $user->setDateOfBirth(new \DateTime($data['dateOfBirth']));
        }
        if (isset($data['sex'])) {
            $user->setSex($data['sex']);
        }

        // Validate user entity
        $errors = $validator->validate($user);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[$error->getPropertyPath()] = $error->getMessage();
            }
            return $this->json(['errors' => $errorMessages], Response::HTTP_BAD_REQUEST);
        }

        // Persist user
        $entityManager->persist($user);
        $entityManager->flush();

        // Send verification email
        $this->emailVerifier->sendEmailConfirmation(
            'api_auth_verify_email',
            $user,
            (new TemplatedEmail())
                ->from(new Address('admin@muscleMind.com', 'MuscleMind'))
                ->to($user->getEmail())
                ->subject('Please Confirm your Email')
                ->htmlTemplate('registration/confirmation_email.html.twig')
        );

        return $this->json([
            'message' => 'User registered successfully. Please check your email to verify your account.',
            'user' => [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'username' => $user->getUsername(),
            ]
        ], Response::HTTP_CREATED);
    }

    #[Route('/verify-email', name: 'verify_email', methods: ['GET'])]
    public function verifyEmail(Request $request): JsonResponse
    {
        $user = $this->getUser();
        
        if (!$user instanceof User) {
            return $this->json(['error' => 'User not authenticated'], Response::HTTP_UNAUTHORIZED);
        }

        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
        } catch (VerifyEmailExceptionInterface $exception) {
            return $this->json(['error' => $exception->getReason()], Response::HTTP_BAD_REQUEST);
        }

        return $this->json(['message' => 'Email verified successfully']);
    }

    #[Route('/resend-verification', name: 'resend_verification', methods: ['POST'])]
    public function resendVerification(): JsonResponse
    {
        $user = $this->getUser();
        
        if (!$user instanceof User) {
            return $this->json(['error' => 'User not authenticated'], Response::HTTP_UNAUTHORIZED);
        }

        if ($user->getIsVerified()) {
            return $this->json(['message' => 'Email already verified']);
        }

        // Resend verification email
        $this->emailVerifier->sendEmailConfirmation(
            'api_auth_verify_email',
            $user,
            (new TemplatedEmail())
                ->from(new Address('admin@muscleMind.com', 'MuscleMind'))
                ->to($user->getEmail())
                ->subject('Please Confirm your Email')
                ->htmlTemplate('registration/confirmation_email.html.twig')
        );

        return $this->json(['message' => 'Verification email sent']);
    }

    #[Route('/me', name: 'me', methods: ['GET'])]
    public function me(): JsonResponse
    {
        $user = $this->getUser();
        
        if (!$user instanceof User) {
            return $this->json(['error' => 'User not authenticated'], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'id' => $user->getId(),
            'email' => $user->getEmail(),
            'username' => $user->getUsername(),
            'roles' => $user->getRoles(),
            'isVerified' => $user->getIsVerified(),
            'score' => $user->getScore(),
            'dateOfBirth' => $user->getDateOfBirth()?->format('Y-m-d'),
            'sex' => $user->getSex(),
        ]);
    }
}

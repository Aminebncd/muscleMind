<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use SymfonyCasts\Bundle\ResetPassword\Controller\ResetPasswordControllerTrait;
use SymfonyCasts\Bundle\ResetPassword\Exception\ResetPasswordExceptionInterface;
use SymfonyCasts\Bundle\ResetPassword\ResetPasswordHelperInterface;

#[Route('/api/auth/reset-password', name: 'api_reset_password_')]
class ResetPasswordController extends AbstractController
{
    use ResetPasswordControllerTrait;

    public function __construct(
        private ResetPasswordHelperInterface $resetPasswordHelper,
        private EntityManagerInterface $entityManager
    ) {
    }

    /**
     * Request a password reset email
     */
    #[Route('/request', name: 'request', methods: ['POST'])]
    public function request(Request $request, MailerInterface $mailer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['email'])) {
            return $this->json(['error' => 'Email is required'], Response::HTTP_BAD_REQUEST);
        }

        $user = $this->entityManager->getRepository(User::class)->findOneBy([
            'email' => $data['email'],
        ]);

        // Do not reveal whether a user account was found or not for security
        if (!$user) {
            return $this->json(['message' => 'If an account exists with that email, a reset link has been sent.']);
        }

        try {
            $resetToken = $this->resetPasswordHelper->generateResetToken($user);
        } catch (ResetPasswordExceptionInterface $e) {
            // For security, we return the same message even if there's an issue
            return $this->json(['message' => 'If an account exists with that email, a reset link has been sent.']);
        }

        $email = (new TemplatedEmail())
            ->from(new Address('admin@muscleMind.com', 'MuscleMind'))
            ->to($user->getEmail())
            ->subject('Your password reset request')
            ->htmlTemplate('reset_password/email.html.twig')
            ->context([
                'resetToken' => $resetToken,
            ]);

        $mailer->send($email);

        return $this->json(['message' => 'If an account exists with that email, a reset link has been sent.']);
    }

    /**
     * Validate reset token
     */
    #[Route('/validate/{token}', name: 'validate', methods: ['GET'])]
    public function validate(string $token): JsonResponse
    {
        try {
            $user = $this->resetPasswordHelper->validateTokenAndFetchUser($token);
        } catch (ResetPasswordExceptionInterface $e) {
            return $this->json([
                'valid' => false,
                'error' => 'This password reset link is invalid or has expired.'
            ], Response::HTTP_BAD_REQUEST);
        }

        return $this->json([
            'valid' => true,
            'email' => $user->getEmail()
        ]);
    }

    /**
     * Reset password with token
     */
    #[Route('/reset', name: 'reset', methods: ['POST'])]
    public function reset(Request $request, UserPasswordHasherInterface $passwordHasher): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['token'], $data['password'])) {
            return $this->json(['error' => 'Token and password are required'], Response::HTTP_BAD_REQUEST);
        }

        try {
            $user = $this->resetPasswordHelper->validateTokenAndFetchUser($data['token']);
        } catch (ResetPasswordExceptionInterface $e) {
            return $this->json([
                'error' => 'This password reset link is invalid or has expired.'
            ], Response::HTTP_BAD_REQUEST);
        }

        // Remove the reset request
        $this->resetPasswordHelper->removeResetRequest($data['token']);

        // Hash and set the new password
        $encodedPassword = $passwordHasher->hashPassword($user, $data['password']);
        $user->setPassword($encodedPassword);
        $this->entityManager->flush();

        return $this->json(['message' => 'Password has been reset successfully']);
    }
}

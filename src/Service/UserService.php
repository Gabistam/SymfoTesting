<?php

// src/Service/UserService.php

namespace App\Service;

class UserService
{
    private $emailService;

    public function __construct(EmailServiceInterface $emailService)
    {
        $this->emailService = $emailService;
    }

    public function registerUser($name, $email)
    {
        // Logique pour l'inscription de l'utilisateur
        // ...

        // Envoi d'un e-mail de confirmation
        $this->emailService->sendEmail('Confirmation d\'inscription', 'Merci pour votre inscription!');
    }

    public function requestPasswordReset($email)
    {
        // Logique pour demander la réinitialisation du mot de passe
        // ...

        // Envoi d'un email avec un lien de réinitialisation
        $this->emailService->sendEmail('Réinitialisation de mot de passe', 'Voici le lien pour réinitialiser votre mot de passe.');
    }
}
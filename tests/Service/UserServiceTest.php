<?php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\UserService;
use App\Service\EmailServiceInterface;

class UserServiceTest extends TestCase
{
    public function testEmailConfirmationSent()
    {
        // Création d'un mock pour le service d'email
        // Un mock est un objet simulé qui imite le comportement d'un objet réel de manière contrôlée
        /** @var EmailServiceInterface&\PHPUnit\Framework\MockObject\MockObject $mockEmailService */
        $mockEmailService = $this->createMock(EmailServiceInterface::class);

        // Configuration du mock pour vérifier l'appel à sendEmail
        // On s'attend à ce que sendEmail soit appelé exactement une fois
        // avec les paramètres spécifiés
        $mockEmailService->expects($this->once()) // Vérifie que la méthode est appelée une seule fois
                         ->method('sendEmail')    // Spécifie la méthode attendue
                         ->with(                  // Vérifie les arguments passés à la méthode
                             $this->equalTo('Confirmation d\'inscription'), // Vérifie le sujet de l'email
                             $this->equalTo('Merci pour votre inscription!') // Vérifie le contenu de l'email
                         );

        // Création d'une instance de UserService avec le mock du service d'email
        /** @var UserService $userService */
        $userService = new UserService($mockEmailService);

        // Act (Exécution de l'action à tester)
        // Appel de la méthode registerUser qui devrait déclencher l'envoi de l'email
        $userService->registerUser('John Doe', 'john@example.com');

        // Assert (Vérification des résultats)
        // Pas d'assertion explicite ici car l'assertion est implicite dans la configuration du mock
        // Si sendEmail n'est pas appelé avec les bons paramètres, le test échouera automatiquement
    }

    public function testPasswordResetEmailSent()
    {
        // Arrange
        /** @var EmailServiceInterface&\PHPUnit\Framework\MockObject\MockObject $mockEmailService */
        $mockEmailService = $this->createMock(EmailServiceInterface::class);

        // Configurer le mock pour s'attendre à ce que sendEmail soit appelé une fois avec les bons paramètres
        $mockEmailService->expects($this->once())
                         ->method('sendEmail')
                         ->with(
                             $this->equalTo('Réinitialisation de mot de passe'),
                             $this->equalTo('Voici le lien pour réinitialiser votre mot de passe.')
                         );

        // Créer une instance de UserService avec le mock
        /** @var UserService $userService */
        $userService = new UserService($mockEmailService);

        // Act
        $userService->requestPasswordReset('john@example.com');

        // Assert
        $this->assertNotNull($mockEmailService);
    }

}
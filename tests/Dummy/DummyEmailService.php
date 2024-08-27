<?php

namespace App\Tests\Dummy;

use App\Service\EmailServiceInterface;

class DummyEmailService implements EmailServiceInterface
{
    public function sendEmail(string $subject, string $message): void
    {
        // Ne rien faire pour les tests
    }
}
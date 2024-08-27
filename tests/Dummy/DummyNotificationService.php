<?php

namespace App\Tests\Dummy;

use App\Service\NotificationServiceInterface;

class DummyNotificationService implements NotificationServiceInterface
{
    public function sendNotification(string $message): void
    {
        // Ne rien faire pour les tests
    }
}
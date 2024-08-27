<?php

// src/Service/NotificationServiceInterface.php

namespace App\Service;

interface NotificationServiceInterface
{
    public function sendNotification(string $message): void;
}
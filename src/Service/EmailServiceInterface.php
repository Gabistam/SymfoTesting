<?php

// src/Service/EmailServiceInterface.php

namespace App\Service;

interface EmailServiceInterface
{
    public function sendEmail(string $subject, string $message): void;
}
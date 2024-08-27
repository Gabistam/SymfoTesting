<?php

namespace App\Service;

interface MembershipServiceInterface
{
    public function isPremiumMember(): bool;
}
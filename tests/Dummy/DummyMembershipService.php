<?php

namespace App\Tests\Dummy;

use App\Service\MembershipServiceInterface;

class DummyMembershipService implements MembershipServiceInterface
{
    public function isPremiumMember(): bool
    {
        return false; // Par défaut, pas un membre premium
    }
}

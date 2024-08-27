<?php

namespace App\Tests\Dummy;

use App\Service\TaxServiceInterface;

class DummyTaxService implements TaxServiceInterface
{
    public function getTaxRate(): float
    {
        return 0.1; // Taux de taxe fictif de 10%
    }
}
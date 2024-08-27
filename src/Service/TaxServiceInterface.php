<?php

namespace App\Service;

interface TaxServiceInterface
{
    public function getTaxRate(): float;
}
<?php

namespace App\Tests\Dummy;

use App\Service\WeatherServiceInterface;

class DummyWeatherService implements WeatherServiceInterface
{
    public function getTemperature(string $city): float
    {
        return 20.0; // Température fictive de 20°C
    }

    public function getCondition(string $city): string
    {
        return "Ensoleillé"; // Condition météo fictive
    }
}
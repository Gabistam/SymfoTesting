<?php

namespace App\Service;

class WeatherApp
{
    private $weatherService;

    public function __construct(WeatherServiceInterface $weatherService)
    {
        $this->weatherService = $weatherService;
    }

    public function getWeatherForecast($city)
    {
        $temperature = $this->weatherService->getTemperature($city);
        $condition = $this->weatherService->getCondition($city);

        if ($temperature > 25) {
            return "Il fait chaud à $city ! Température : {$temperature}°C, Conditions : $condition";
        } elseif ($temperature < 10) {
            return "Il fait froid à $city ! Température : {$temperature}°C, Conditions : $condition";
        } else {
            return "Le temps est agréable à $city. Température : {$temperature}°C, Conditions : $condition";
        }
    }
}
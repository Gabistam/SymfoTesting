<?php

namespace App\Service;

interface WeatherServiceInterface
{
    /**
     * Obtient la température pour une ville donnée.
     *
     * @param string $city Le nom de la ville
     * @return float La température en degrés Celsius
     */
    public function getTemperature(string $city): float;

    /**
     * Obtient les conditions météorologiques pour une ville donnée.
     *
     * @param string $city Le nom de la ville
     * @return string Description des conditions météorologiques
     */
    public function getCondition(string $city): string;
}
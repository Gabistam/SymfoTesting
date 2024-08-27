<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Service\WeatherApp;
use App\Service\WeatherServiceInterface;

class WeatherAppTest extends TestCase
{
    public function testHotWeather()
    {
        // Créer un stub pour le service météo
        /** @var WeatherServiceInterface&\PHPUnit\Framework\MockObject\Stub $stubWeatherService */
        $stubWeatherService = $this->createStub(WeatherServiceInterface::class);

        // Configurer le stub pour simuler un temps chaud
        $stubWeatherService->method('getTemperature')->willReturn(30.0); // Notez le .0 ici
        $stubWeatherService->method('getCondition')->willReturn('Ensoleillé');

        // Créer une instance de WeatherApp avec le stub
        $weatherApp = new WeatherApp($stubWeatherService);

        // Tester la prévision pour un temps chaud
        $forecast = $weatherApp->getWeatherForecast('Paris');
        $this->assertStringContainsString('Il fait chaud à Paris', $forecast);
        $this->assertStringContainsString('30°C', $forecast);
        $this->assertStringContainsString('Ensoleillé', $forecast);
    }

    // Les méthodes testColdWeather et testMildWeather doivent également être ajustées de la même manière
    public function testColdWeather()
    {
        $stubWeatherService = $this->createStub(WeatherServiceInterface::class);
        $stubWeatherService->method('getTemperature')->willReturn(5.0);
        $stubWeatherService->method('getCondition')->willReturn('Nuageux');

        $weatherApp = new WeatherApp($stubWeatherService);

        $forecast = $weatherApp->getWeatherForecast('Moscou');
        $this->assertStringContainsString('Il fait froid à Moscou', $forecast);
        $this->assertStringContainsString('5°C', $forecast);
        $this->assertStringContainsString('Nuageux', $forecast);
    }

    public function testMildWeather()
    {
        $stubWeatherService = $this->createStub(WeatherServiceInterface::class);
        $stubWeatherService->method('getTemperature')->willReturn(20.0);
        $stubWeatherService->method('getCondition')->willReturn('Partiellement nuageux');

        $weatherApp = new WeatherApp($stubWeatherService);

        $forecast = $weatherApp->getWeatherForecast('Londres');
        $this->assertStringContainsString('Le temps est agréable à Londres', $forecast);
        $this->assertStringContainsString('20°C', $forecast);
        $this->assertStringContainsString('Partiellement nuageux', $forecast);
    }
}
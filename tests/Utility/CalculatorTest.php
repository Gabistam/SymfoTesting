<?php

// tests/Utility/CalculatorTest.php
namespace App\Tests\Utility;

use App\Utility\Calculator;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    public function testMultiply()
    {
        // Arrange
        $calculator = new Calculator();

        // Act
        $result = $calculator->multiply(6, 4);

        // Assert
        $this->assertEquals(24, $result, "La méthode multiply doit retourner 6 * 4 = 24");
    }

    public function testDivide()
    {
        // Arrange
        $calculator = new Calculator();

        // Act
        $result = $calculator->divide(20, 4);

        // Assert
        $this->assertEquals(5, $result, "La méthode divide doit retourner 20 / 4 = 5");
    }

    public function testDivideByZero()
    {
        // Arrange
        $calculator = new Calculator();

        // Assert
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Division by zero is not allowed.");

        // Act
        $calculator->divide(20, 0);
    }

    public function testAddMultipleScenarios()
    {
        // Arrange
        $calculator = new Calculator();

        // Act & Assert
        $this->assertEquals(5, $calculator->add(2, 3), "2 + 3 devrait être 5");
        $this->assertEquals(0, $calculator->add(-3, 3), "-3 + 3 devrait être 0");
        $this->assertEquals(-7, $calculator->add(-5, -2), "-5 + -2 devrait être -7");
        $this->assertEquals(10.5, $calculator->add(7, 3.5), "7 + 3.5 devrait être 10.5");
    }

    public function testAddSubtractMultiply()
    {
        // Arrange
        $calculator = new Calculator();

        // Act & Assert - Addition
        $this->assertEquals(15, $calculator->add(10, 5), "10 + 5 devrait être 15");
        $this->assertEquals(7.5, $calculator->add(3.5, 4), "3.5 + 4 devrait être 7.5");

        // Act & Assert - Soustraction
        $this->assertEquals(5, $calculator->subtract(10, 5), "10 - 5 devrait être 5");
        $this->assertEquals(-1, $calculator->subtract(3, 4), "3 - 4 devrait être -1");

        // Act & Assert - Multiplication
        $this->assertEquals(50, $calculator->multiply(10, 5), "10 * 5 devrait être 50");
        $this->assertEquals(14, $calculator->multiply(7, 2), "7 * 2 devrait être 14");
    }
}

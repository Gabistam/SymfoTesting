<?php

namespace App\Tests\Service;

use App\Service\ProductService;
use App\Service\TaxServiceInterface;
use App\Service\MembershipServiceInterface;
use PHPUnit\Framework\TestCase;

/**
 * Classe de test pour ProductService
 * Cette classe contient des tests unitaires pour vérifier le bon fonctionnement
 * des méthodes de calcul de prix et d'application de réduction de ProductService.
 */
class ProductServiceTest extends TestCase
{
    /**
     * Test du calcul du prix total avec application de la TVA
     * Ce test vérifie que le prix final est correctement calculé pour un client non premium
     */
    public function testCalculateTotalPrice()
    {
        // Création d'un stub pour le service de taxe
        /** @var TaxServiceInterface&\PHPUnit\Framework\MockObject\Stub */
        $stubTaxService = $this->createStub(TaxServiceInterface::class);
        // Configuration du stub pour retourner un taux de TVA de 20%
        $stubTaxService->method('getTaxRate')->willReturn(0.2);

        // Création d'un stub pour le service d'adhésion
        /** @var MembershipServiceInterface&\PHPUnit\Framework\MockObject\Stub */
        $stubMembershipService = $this->createStub(MembershipServiceInterface::class);
        // Configuration du stub pour simuler un client non premium
        $stubMembershipService->method('isPremiumMember')->willReturn(false);

        // Création d'une instance de ProductService avec les stubs
        $productService = new ProductService($stubTaxService, $stubMembershipService);

        // Calcul du prix final pour un produit de 100€
        $finalPrice = $productService->calculateFinalPrice(100);

        // Vérification que le prix final est correct (100€ + 20% TVA = 120€)
        $this->assertEquals(120, $finalPrice, "Le prix final devrait être 100€ + 20% de TVA, soit 120€.");
    }

    /**
     * Test de l'application de la réduction pour un membre premium
     * Ce test vérifie que la réduction est correctement appliquée pour un client premium
     */
    public function testApplyDiscountForPremiumMember()
    {
        // Création d'un stub pour le service de taxe (non utilisé dans ce test mais nécessaire pour le constructeur)
        /** @var TaxServiceInterface&\PHPUnit\Framework\MockObject\Stub */
        $stubTaxService = $this->createStub(TaxServiceInterface::class);
        
        // Création d'un stub pour le service d'adhésion
        /** @var MembershipServiceInterface&\PHPUnit\Framework\MockObject\Stub */
        $stubMembershipService = $this->createStub(MembershipServiceInterface::class);
        // Configuration du stub pour simuler un client premium
        $stubMembershipService->method('isPremiumMember')->willReturn(true);

        // Création d'une instance de ProductService avec les stubs
        $productService = new ProductService($stubTaxService, $stubMembershipService);

        // Application de la réduction sur un prix de 100€
        $discountedPrice = $productService->applyDiscount(100);

        // Vérification que la réduction de 10% est correctement appliquée (100€ - 10% = 90€)
        $this->assertEquals(90, $discountedPrice, "Le prix après réduction pour un membre premium devrait être 90€.");
    }
}
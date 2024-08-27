<?php

namespace App\Service;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductService
{
    private $entityManager;
    private $taxService;
    private $membershipService;

    public function __construct(
        EntityManagerInterface $entityManager, 
        TaxServiceInterface $taxService, 
        MembershipServiceInterface $membershipService
    ) {
        $this->entityManager = $entityManager;
        $this->taxService = $taxService;
        $this->membershipService = $membershipService;
    }

    // Méthode pour créer un produit
    public function createProduct(string $name, float $price): Product
    {
        $product = new Product();
        $product->setName($name);
        $product->setPrice($price);

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return $product;
    }

    // Méthode pour calculer le prix final avec taxes et réductions
    public function calculateFinalPrice(float $price): float
    {
        $discountedPrice = $this->applyDiscount($price);
        $taxRate = $this->taxService->getTaxRate();
        $finalPrice = $discountedPrice * (1 + $taxRate);

        return $finalPrice;
    }

    // Méthode pour appliquer une réduction si l'utilisateur est membre premium
    public function applyDiscount(float $price): float
    {
        if ($this->membershipService->isPremiumMember()) {
            return $price * 0.9; // Réduction de 10% pour les membres premium
        }

        return $price;
    }
}

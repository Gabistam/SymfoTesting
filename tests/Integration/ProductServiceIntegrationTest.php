<?php

namespace App\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Service\ProductService;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class ProductServiceIntegrationTest extends KernelTestCase
{
    private $productService;
    private $entityManager;

    protected function setUp(): void
    {
        // Boot Symfony kernel
        self::bootKernel();

        // Récupérer le conteneur de services
        $container = static::getContainer();
        $this->productService = $container->get(ProductService::class);
        $this->entityManager = $container->get(EntityManagerInterface::class);
    }

    public function testCreateProduct()
    {
        // Créez un nouveau produit via le ProductService
        $productName = 'Test Product';
        $productPrice = 19.99;

        $product = $this->productService->createProduct($productName, $productPrice);

        // Vérifiez que le produit a été persisté
        $persistedProduct = $this->entityManager->getRepository(Product::class)->find($product->getId());

        // Assertions
        $this->assertNotNull($persistedProduct);
        $this->assertEquals($productName, $persistedProduct->getName());
        $this->assertEquals($productPrice, $persistedProduct->getPrice());
    }

    protected function tearDown(): void
    {
        // Nettoyer la base de données après chaque test
        $this->entityManager->remove($this->productService->getLastCreatedProduct());
        $this->entityManager->flush();

        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
<?php

// tests/Service/OrderServiceTest.php

namespace App\Tests\Service;

use PHPUnit\Framework\TestCase;
use App\Service\OrderService;
use App\Service\NotificationServiceInterface;

class OrderServiceTest extends TestCase
{
    public function testShippingNotificationSent()
    {
        // Arrange
        /** @var NotificationServiceInterface&\PHPUnit\Framework\MockObject\MockObject $mockNotificationService */
        $mockNotificationService = $this->createMock(NotificationServiceInterface::class);

        // Configurer le mock pour s'attendre à ce que sendNotification soit appelé une fois avec le bon message
        $mockNotificationService->expects($this->once())
                                ->method('sendNotification')
                                ->with($this->equalTo('Votre commande a été expédiée!'));

        // Créer une instance de OrderService avec le mock
        $orderService = new OrderService($mockNotificationService);

        // Act
        $orderService->shipOrder(12345, '123 Main St');

        // Assert
        // L'assertion est implicite dans l'attente (expects) définie sur le mock
    }
}
<?php

interface DeliveryStrategy {
    public function calculateCost($distance);
}

class SelfPickupStrategy implements DeliveryStrategy {
    public function calculateCost($distance) {
        // Без вартості доставки при самовивозі
        return 0;
    }
}

class ExternalDeliveryStrategy implements DeliveryStrategy {
    public function calculateCost($distance) {
        // Розрахувати вартість доставки за допомогою API зовнішньої служби доставки
    }
}

class OwnDeliveryStrategy implements DeliveryStrategy {
    public function calculateCost($distance) {
        // Розрахувати вартість доставки за допомогою власного API служби доставки
    }
}

class DeliveryContext {
    private $deliveryStrategy;

    public function __construct(DeliveryStrategy $deliveryStrategy) {
        $this->deliveryStrategy = $deliveryStrategy;
    }

    public function calculateDeliveryCost($distance) {
        return $this->deliveryStrategy->calculateCost($distance);
    }
}

$distance = 10; // Відстань між рестораном та клієнтом у кілометрах

$deliveryContext = new DeliveryContext(new SelfPickupStrategy());
$cost = $deliveryContext->calculateDeliveryCost($distance);

$deliveryContext = new DeliveryContext(new ExternalDeliveryStrategy());
$cost = $deliveryContext->calculateDeliveryCost($distance); 

$deliveryContext = new DeliveryContext(new OwnDeliveryStrategy());
$cost = $deliveryContext->calculateDeliveryCost($distance); 

?>
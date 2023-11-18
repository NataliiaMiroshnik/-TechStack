<?php

abstract class Entity {
    protected $data;

    public function __construct($data) {
        $this->data = $data;
    }

    public function update() {
        $this->getData();
        $this->validateData();
        $this->prepareRequest();
        $this->sendResponse();
    }

    protected function getData() {
        // Отримання даних з REST API
    }

    protected function validateData() {
        // Базова валідація
    }

    protected function prepareRequest() {
        // Подготовка запиту на збереження інформації
    }

    protected function sendResponse() {
        // Відправка відповіді - код відповіді та статус
    }
}

class Product extends Entity {
    protected function validateData() {
        parent::validateData();

        // Додаткова валідація для продукту

        // Відправка сповіщення адміністратору у месенджер
        $this->notifyAdmin();
    }

    protected function notifyAdmin() {
        // Логіка відправки сповіщення
    }
}

class User extends Entity {
    protected function validateData() {
        parent::validateData();

        // Додаткова валідація для користувача

        // Заборона зміни поля email
        unset($this->data['email']);
    }
}

class Order extends Entity {
    protected function sendResponse() {
        parent::sendResponse();

        // Повернення JSON-подання сутності Замовлення
        $this->sendJsonResponse();
    }

    protected function sendJsonResponse() {
        // Логіка повернення JSON-подання
    }
}

$productData = ['name' => 'Product 1', 'price' => 100];
$product = new Product($productData);
$product->update();

$userData = ['name' => 'User 1', 'email' => 'user1@example.com'];
$user = new User($userData);
$user->update();

$orderData = ['id' => 1, 'product' => 'Product 1', 'user' => 'User 1'];
$order = new Order($orderData);
$order->update();

?>
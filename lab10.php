<?php
interface Mediator {
    public function notify(object $sender, string $event);
}

class OrderForm implements Mediator {
    private $deliveryDate;
    private $isForAnotherPerson;
    private $name;
    private $phone;
    private $isPickup;

    public function notify(object $sender, string $event) {
        if ($event == 'changeDeliveryDate') {
            $this->updateDeliveryTimeSlots($sender->getDeliveryDate());
        } elseif ($event == 'changeIsForAnotherPerson') {
            $this->updateIsForAnotherPersonFields($sender->getIsForAnotherPerson());
        } elseif ($event == 'changeIsPickup') {
            $this->updateIsPickupFields($sender->getIsPickup());
        }
    }

    public function updateDeliveryTimeSlots($deliveryDate) {
        // Оновлювати доступні проміжки часу доставки на основі обраної дати
    }

    public function updateIsForAnotherPersonFields($isForAnotherPerson) {
        // Зробити поля імені та телефону обов'язковими для заповнення, якщо isForAnotherPerson має значення true
    }

    public function updateIsPickupFields($isPickup) {
        // Зробити всі поля, пов'язані з інформацією про доставку, неактивними, якщо isPickup має значення true
    }
}

class DeliveryDate {
    private $mediator;
    private $deliveryDate;

    public function __construct(Mediator $mediator) {
        $this->mediator = $mediator;
    }

    public function setDeliveryDate($deliveryDate) {
        $this->deliveryDate = $deliveryDate;
        $this->mediator->notify($this, 'changeDeliveryDate');
    }

    public function getDeliveryDate() {
        return $this->deliveryDate;
    }
}

class IsForAnotherPerson {
    private $mediator;
    private $isForAnotherPerson;

    public function __construct(Mediator $mediator) {
        $this->mediator = $mediator;
    }

    public function setIsForAnotherPerson($isForAnotherPerson) {
        $this->isForAnotherPerson = $isForAnotherPerson;
        $this->mediator->notify($this, 'changeIsForAnotherPerson');
    }

    public function getIsForAnotherPerson() {
        return $this->isForAnotherPerson;
    }
}

class IsPickup {
    private $mediator;
    private $isPickup;

    public function __construct(Mediator $mediator) {
        $this->mediator = $mediator;
    }

    public function setIsPickup($isPickup) {
        $this->isPickup = $isPickup;
        $this->mediator->notify($this, 'changeIsPickup');
    }

    public function getIsPickup() {
        return $this->isPickup;
    }
}

?>
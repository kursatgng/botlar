<?php
class OrderService {
    private $orderModel;

    public function __construct($orderModel) {
        $this->orderModel = $orderModel;
    }

    public function createOrder($userId, $amount, $price, $type) {
        $this->orderModel->user_id = $userId;
        $this->orderModel->amount = $amount;
        $this->orderModel->price = $price;
        $this->orderModel->type = $type;

        return $this->orderModel->create();
    }

    public function updateOrderStatus($orderId, $status) {
        $this->orderModel->id = $orderId;
        return $this->orderModel->updateStatus($status);
    }

    public function getBuyOrders() {
        return $this->orderModel->getBuyOrders();
    }

    public function getSellOrders() {
        return $this->orderModel->getSellOrders();
    }

    public function getPriceData() {
        return $this->orderModel->getPriceData();
    }
}
?>

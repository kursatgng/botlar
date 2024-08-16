<?php
class TradeService {
    private $tradeModel;

    public function __construct($tradeModel) {
        $this->tradeModel = $tradeModel;
    }

    public function processPendingOrders() {
        return $this->tradeModel->processPendingOrders();
    }
}
?>

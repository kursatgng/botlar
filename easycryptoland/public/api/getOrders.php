<?php
require_once '../../src/config/database.php';
require_once '../../src/models/Order.php';

$database = new Database();
$db = $database->getConnection();

$order = new Order($db);

$buyOrders = $order->getBuyOrders();
$sellOrders = $order->getSellOrders();
$priceData = $order->getPriceData();

echo json_encode([
    'buyOrders' => $buyOrders,
    'sellOrders' => $sellOrders,
    'priceData' => $priceData
]);
?>

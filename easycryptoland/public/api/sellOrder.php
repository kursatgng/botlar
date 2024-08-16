<?php
require_once '../../src/config/database.php';
require_once '../../src/models/Order.php';

$database = new Database();
$db = $database->getConnection();

$order = new Order($db);

$order->user_id = $_POST['user_id']; // Örnek kullanıcı
$order->amount = $_POST['amount'];
$order->price = $_POST['price'];
$order->type = 'sell';

if($order->create()) {
    echo json_encode(["message" => "Satış emri başarıyla oluşturuldu."]);
} else {
    echo json_encode(["message" => "Satış emri oluşturulamadı."]);
}
?>

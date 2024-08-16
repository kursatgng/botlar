<?php
require_once '../../src/config/database.php';
require_once '../../src/models/Order.php';

$database = new Database();
$db = $database->getConnection();

$order = new Order($db);

$order->user_id = $_POST['user_id']; // Örnek kullanıcı ID
$order->amount = $_POST['amount'];
$order->price = $_POST['price'];
$order->type = 'buy';

if ($order->create()) {
    // WebSocket sunucusuna bağlan ve mesaj gönder
    $msg = json_encode([
        'type' => 'buy',
        'amount' => $order->amount,
        'price' => $order->price,
        'user_id' => $order->user_id
    ]);

    $socket = stream_socket_client('tcp://localhost:8080', $errno, $errstr);
    if (!$socket) {
        echo "$errstr ($errno)<br />\n";
    } else {
        fwrite($socket, $msg);
        fclose($socket);
    }

    echo json_encode(["message" => "Alış emri başarıyla oluşturuldu."]);
} else {
    echo json_encode(["message" => "Alış emri oluşturulamadı."]);
}
?>

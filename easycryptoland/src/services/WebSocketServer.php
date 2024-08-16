<?php
require 'vendor/autoload.php'; // WebSocket kütüphanesi için gerekli

$server = new Ratchet\App('localhost', 8080);

$server->route('/orders', new class implements Ratchet\MessageComponentInterface {
    public function onOpen($conn) {
        // Yeni bağlantı açıldığında
    }

    public function onMessage($conn, $message) {
        // Mesaj alındığında
        $data = json_decode($message);
        // İşlem yapılabilir
    }

    public function onClose($conn) {
        // Bağlantı kapandığında
    }

    public function onError($conn, \Exception $e) {
        $conn->close();
    }
}, ['*']);

$server->run();
?>

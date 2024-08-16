<?php
// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=easyTokenDB', 'root', 'password');

$data = json_decode(file_get_contents('php://input'), true);

$type = $data['type'];
$amount = $data['amount'];
$price = $data['price'];

// Insert transaction into the database
$stmt = $pdo->prepare('INSERT INTO transactions (user_id, type, amount, price) VALUES (1, :type, :amount, :price)');
$stmt->execute(['type' => $type, 'amount' => $amount, 'price' => $price]);

echo json_encode(['success' => true]);

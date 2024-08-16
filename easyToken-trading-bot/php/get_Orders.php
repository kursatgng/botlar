<?php
// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=easyTokenDB', 'root', 'password');

// Get all orders
$stmt = $pdo->query('SELECT type, amount, price FROM transactions ORDER BY date DESC');
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($orders);

<?php
// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=easyTokenDB', 'root', 'password');

// Get the latest price
$stmt = $pdo->query('SELECT price FROM prices ORDER BY date DESC LIMIT 1');
$price = $stmt->fetchColumn();

echo json_encode(['price' => $price]);

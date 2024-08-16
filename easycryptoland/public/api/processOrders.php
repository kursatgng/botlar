<?php
require_once '../../src/config/database.php';
require_once '../../src/models/Trade.php';

$database = new Database();
$db = $database->getConnection();

$trade = new Trade($db);

$trade->processPendingOrders();
?>

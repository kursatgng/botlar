<?php
require_once '../inc/db.php';

function fetchMarketData() {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, API_URL);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . API_KEY));

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// Alım-Satım işlemi gerçekleştir
function executeTrade($price, $volume) {
    $conn = getDbConnection();

    $sql = "INSERT INTO trades (price, volume, trade_time) VALUES ('$price', '$volume', NOW())";
    
    if ($conn->query($sql) === TRUE) {
        echo "Yeni işlem başarıyla kaydedildi!";
    } else {
        echo "Hata: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}

// Bot çalıştırma
$data = fetchMarketData();
$price = $data['price'];
$volume = $data['volume'];

// Alım satım stratejisi
if ($price < 500) {
    executeTrade($price, $volume);
} else {
    echo "Fiyat 500'ün üzerinde, işlem yapılmadı.";
}
?>

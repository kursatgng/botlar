<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyToken Trading Bot</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/chart.js"></script>
</head>
<body>
    <h1>EasyToken Trading Bot Dashboard</h1>

    <div class="chart-container">
        <canvas id="tradeChart"></canvas>
    </div>

    <script>
        // Gerçek zamanlı veri için AJAX kullanımı
        setInterval(function() {
            fetch('api/tradebot.php')
            .then(response => response.json())
            .then(data => {
                updateChart(data);
            });
        }, 5000); // 5 saniyede bir güncelle

        function updateChart(data) {
            const ctx = document.getElementById('tradeChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.timestamps,
                    datasets: [{
                        label: 'Price',
                        data: data.prices,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                }
            });
        }
    </script>
</body>
</html>

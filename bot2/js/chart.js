// Veriyi dinamik olarak güncellemek için bir fonksiyon
function fetchDataAndRenderChart() {
    fetch('api/tradebot.php')
        .then(response => response.json())
        .then(data => {
            updateChart(data);
        })
        .catch(error => console.error('Veri alımı hatası:', error));
}

// Grafik güncelleme fonksiyonu
function updateChart(data) {
    const ctx = document.getElementById('tradeChart').getContext('2d');
    
    const chart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: data.timestamps,
            datasets: [{
                label: 'EasyToken Price',
                data: data.prices,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: false
            }]
        },
        options: {
            scales: {
                x: {
                    type: 'time',
                    time: {
                        unit: 'minute'
                    }
                },
                y: {
                    beginAtZero: true
                }
            },
            responsive: true,
            maintainAspectRatio: false
        }
    });
}

// Sayfa yüklendiğinde grafiği oluştur
document.addEventListener('DOMContentLoaded', function() {
    fetchDataAndRenderChart();
    
    // Veriyi her 5 saniyede bir güncelle
    setInterval(fetchDataAndRenderChart, 5000);
});

document.getElementById('trade-form').addEventListener('submit', function (e) {
    e.preventDefault();

    const orderType = document.getElementById('order-type').value;
    const orderAmount = document.getElementById('order-amount').value;
    const orderPrice = document.getElementById('order-price').value;

    const orderItem = document.createElement('li');
    orderItem.textContent = `${orderAmount} EasyToken @ ${orderPrice} USDT`;

    if (orderType === 'buy') {
        document.getElementById('buy-orders').appendChild(orderItem);
    } else {
        document.getElementById('sell-orders').appendChild(orderItem);
    }

    // Form alanlarını temizle
    document.getElementById('order-amount').value = '';
    document.getElementById('order-price').value = '';
});

// Grafik Verilerini Hazırlama
const ctx = document.getElementById('priceChart').getContext('2d');
const priceChart = new Chart(ctx, {
    type: 'candlestick',
    data: {
        datasets: [{
            label: 'EasyToken Fiyat Grafiği',
            data: [], // Veri seti burada gerçek zamanlı olarak güncellenecek
        }]
    },
    options: {
        responsive: true,
        scales: {
            x: {
                type: 'time',
                time: {
                    unit: 'minute'
                }
            }
        }
    }
});

// Grafik Güncelleyici Fonksiyon
function updateChartData(newData) {
    const chartData = priceChart.data.datasets[0].data;
    chartData.push(newData);

    // Eski verileri kaldır, grafikte aşırı doluluk olmasını önler
    if (chartData.length > 100) {
        chartData.shift();
    }

    priceChart.update();
}

// Gerçek Zamanlı Veri Çekme
function fetchRealTimeData() {
    fetch('/api/getOrders.php')
        .then(response => response.json())
        .then(data => {
            updateChartData(data.priceData);

            const buyOrders = data.buyOrders;
            const sellOrders = data.sellOrders;

            // Alış Emirlerini Güncelle
            const buyOrdersList = document.getElementById('buy-orders');
            buyOrdersList.innerHTML = '';
            buyOrders.forEach(order => {
                const listItem = document.createElement('li');
                listItem.textContent = `${order.amount} EasyToken @ ${order.price} USDT`;
                buyOrdersList.appendChild(listItem);
            });

            // Satış Emirlerini Güncelle
            const sellOrdersList = document.getElementById('sell-orders');
            sellOrdersList.innerHTML = '';
            sellOrders.forEach(order => {
                const listItem = document.createElement('li');
                listItem.textContent = `${order.amount} EasyToken @ ${order.price} USDT`;
                sellOrdersList.appendChild(listItem);
            });
        })
        .catch(error => console.error('Veri çekme hatası:', error));
}

// Gerçek zamanlı veri çekme fonksiyonunu her 5 saniyede bir çalıştır
setInterval(fetchRealTimeData, 5000);

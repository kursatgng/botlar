document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('trade-form');
    const priceDisplay = document.getElementById('price');
    const ordersDisplay = document.getElementById('orders');

    // Form Submit Event
    form.addEventListener('submit', function (e) {
        e.preventDefault();

        const type = document.getElementById('type').value;
        const amount = document.getElementById('amount').value;
        const price = document.getElementById('price').value;

        fetch('php/trade.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ type, amount, price }),
        })
        .then(response => response.json())
        .then(data => {
            alert('Order placed successfully!');
            loadOrders();
        })
        .catch(error => console.error('Error:', error));
    });

    // Load Live Price
    function loadPrice() {
        fetch('php/get_price.php')
            .then(response => response.json())
            .then(data => {
                priceDisplay.textContent = `₺ ${data.price}`;
            })
            .catch(error => console.error('Error:', error));
    }

    // Load Orders
    function loadOrders() {
        fetch('php/get_orders.php')
            .then(response => response.json())
            .then(data => {
                let ordersHTML = '';
                data.forEach(order => {
                    ordersHTML += `<p>${order.type} ${order.amount} at ₺${order.price}</p>`;
                });
                ordersDisplay.innerHTML = ordersHTML;
            })
            .catch(error => console.error('Error:', error));
    }

    // Initial Load
    loadPrice();
    loadOrders();

    // Update price every 5 seconds
    setInterval(loadPrice, 5000);
});

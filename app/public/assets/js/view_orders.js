document.addEventListener('DOMContentLoaded', loadOrders);

async function loadOrders() {
    const orders = await fetchOrders();
    if (orders) {
        displayOrders(orders);
    }
}

async function fetchOrders() {
    try {
        const response = await fetch('/api/bookings/allOrders');
        if (!response.ok) throw new Error('Failed to fetch orders');
        return await response.json();
    } catch (error) {
        console.error(error);
        return null;
    }
}

function displayOrders(orders) {
    const container = document.getElementById('orders-container');
    if (orders.length === 0) {
        container.innerHTML = '<p>No orders found.</p>';
        return;
    }
    orders.forEach(order => container.appendChild(createOrderElement(order)));
}

function createOrderElement(order) {
    const orderDiv = document.createElement('div');
    orderDiv.classList.add('order-item', 'm-3', 'border', 'p-2', 'bg-white', 'rounded');

    orderDiv.innerHTML = `
        <div class="order-header border p-3 rounded">
            <h4>Order Number: ${order.order_number} | User: ${order.user_name} (${order.user_email})</h4>
            <h4>Receiving Email: ${order.receiving_email}</h4>
        </div>
        <div class="order-details p-3">
            <h6 class="mb-2">Bookings:</h6>
            <ul class="list-group list-group-flush">
                ${order.bookings.map(booking => `
                    <li class="list-group-item">
                        <strong>Ticket Type:</strong> ${formatTicketType(booking.ticket_type)} |
                        <strong>Quantity:</strong> ${booking.quantity} |
                        <strong>Ticket Subtype:</strong> ${formatTicketSubType(booking.ticket_subtype)}
                    </li>
                `).join('')}
            </ul>
        </div>
    `;
    return orderDiv;
}

function formatTicketType(ticketType) {
    switch(ticketType) {
        case 'pass':
            return 'Pass';
        case 'dance_show':
            return 'Dance Show';
        case 'reservation':
            return 'Reservation';
        case 'tour':
            return 'Tour';
        case 'teylers_event':
            return 'Teylers Event';
        default:
            return 'Unknown';
    }
}

function formatTicketSubType(ticketSubType) {
    return ticketSubType ? ticketSubType : '-'; 
}

import { ShoppingCart } from './classes/ShoppingCart.js';
import { Booking } from './classes/Booking.js';

document.addEventListener('DOMContentLoaded', async function () {
    const urlParams = new URLSearchParams(window.location.search);
    const paymentStatus = urlParams.get('redirect_status');
    let bookings = [];

    if (paymentStatus === 'succeeded') {
        const shoppingCart = ShoppingCart.getInstance();

        const orderNumberHolder = document.getElementById('order-number');
        const orderConfirmationHolder = document.getElementById('confirmation-message');
    
        const orderItems = Array.from(shoppingCart.items.values()).map((orderItemGroup) => {
            const item = orderItemGroup[0];
            const quantity = orderItemGroup.length;
            return {
                quantity: quantity,
                type: item.type,
                subType: item.subType == '' ? null : item.subType,
                ticketId: item.id,
            };
        });
    
        orderItems.forEach(async (orderItem) => {
            const booking = new Booking(orderItem.type, orderItem.subType, orderItem.ticketId, orderItem.quantity);
    
            bookings.push(booking);
        });
    
        try {
            const response = await fetch('http://localhost/api/bookings', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    bookings,
                    receivingEmail: localStorage.getItem('email')
                }),
            });
    
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
    
            const data = await response.json();
            console.log(data);
            orderNumberHolder.textContent = data.order_number;
            orderConfirmationHolder.textContent = data.receiving_email;
        } catch (error) {
            console.error('Error posting to Stripe:', error);
            throw error;
        }

        shoppingCart.clearCart();
    }
});
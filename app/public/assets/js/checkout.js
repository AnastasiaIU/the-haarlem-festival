import { StripeHandler } from './classes/StripeHandler.js';
import { Booking } from './classes/Booking.js';
import { ShoppingCart } from './classes/ShoppingCart.js';

document.addEventListener('DOMContentLoaded', async function () {
    let cartData = JSON.parse(localStorage.getItem('cart')) || [];
    let cart = new Map(cartData);
    let cartItemsContainer = document.getElementById('cart-items');
    let totalPriceElement = document.getElementById('total-price');
    const paymentForm = document.getElementById('payment-form');
    const shoppingCart = new ShoppingCart();
    const stripeHandler = new StripeHandler();
    const booking = new Booking();

    const combinedTickets = shoppingCart.getCombineTickets(cart);
    const totalPrice = shoppingCart.renderTickets(combinedTickets, cartItemsContainer, totalPriceElement);
    stripeHandler.init();

    const tickets = Array.from(combinedTickets.values()).map(item => ({
        name: item.name,
        quantity: item.quantity,
        price: Math.round(item.price * 100)
    }));

    paymentForm.addEventListener('submit', async function (event) {
        event.preventDefault();

        const email = document.getElementById('email').value;
        const repeatEmail = document.getElementById('repeatEmail').value;

        if (!email || !repeatEmail) {
            const errorElement = document.getElementById('errorMessage');
            errorElement.textContent = 'Please fill in all required fields.';
            return;
        }

        if (email !== repeatEmail) {
            const errorElement = document.getElementById('errorMessage');
            errorElement.textContent = 'The email addresses do not match.';
            return;
        }
    
        try {
            const data = await stripeHandler.createPayment(totalPrice, tickets);
    
            if (data.error) {
                const errorElement = document.getElementById('ideal-errors');
                errorElement.textContent = data.error.message;
            } else {
                const result = await stripeHandler.confirmPayment(data.clientSecret);
                if (result.error) {
                    const errorElement = document.getElementById('ideal-errors');
                    errorElement.textContent = result.error.message;
                }
            }
        } catch (error) {
            console.error('Error:', error);
            const errorElement = document.getElementById('ideal-errors');
            errorElement.textContent = 'An error occurred while processing your payment. Please try again.';
        }
    });
});
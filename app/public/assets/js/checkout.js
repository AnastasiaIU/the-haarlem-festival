import { StripeHandler } from './classes/StripeHandler.js';
import { ShoppingCart } from './classes/ShoppingCart.js';

document.addEventListener('DOMContentLoaded', async function () {
    let cartItemsContainer = document.getElementById('cart-items');
    let totalPriceElement = document.getElementById('total-price');
    const paymentForm = document.getElementById('payment-form');
    const shoppingCart = ShoppingCart.getInstance();
    const stripeHandler = new StripeHandler();
    const totalPrice = Math.round(shoppingCart.getTotalPrice() * 100);

    shoppingCart.renderCheckout(cartItemsContainer, totalPriceElement);
    stripeHandler.init();

    const tickets = Array.from(shoppingCart.items.values()).map((ticketsGroup) => {
        const item = ticketsGroup[0];
        const quantity = ticketsGroup.length;
        return {
            name: item.name + (item.subType ? ` (${item.subType})` : ''),
            quantity: quantity,
            price: Math.round(item.price * 100)
        };
    });

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

        localStorage.setItem('email', email);
    
        try {
            const data = await stripeHandler.createPayment(totalPrice, tickets);
    
            if (data.error) {
                const errorElement = document.getElementById('ideal-errors');
                errorElement.textContent = data.error.message;
            } else {
                const result = await stripeHandler.confirmPayment(data.clientSecret);
                console.log(result);
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
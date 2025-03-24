import { fetchFromApi } from './main.js';
import { Booking } from './classes/Booking.js';

document.addEventListener('DOMContentLoaded', async function () {
    let cartData = JSON.parse(localStorage.getItem('cart')) || [];
    let cart = new Map(cartData);
    let cartItemsContainer = document.getElementById('cart-items');
    let totalPriceElement = document.getElementById('total-price');
    let totalPrice = 0;

    let combinedTickets = new Map();
    cart.forEach(tickets => {
        tickets.forEach(item => {
            let key = `${item.name}-${item.subType}`;
            if (combinedTickets.has(key)) {
                combinedTickets.get(key).quantity += 1;
            } else {
                combinedTickets.set(key, { ...item, quantity: 1 });
            }
        });
    });

    combinedTickets.forEach(item => {
        let ticketContainer = document.createElement('div');
        ticketContainer.classList.add('cart-item-c');
    
        let nameElement = document.createElement('p');
        nameElement.textContent = item.name;
        ticketContainer.appendChild(nameElement);
    
        let quantityElement = document.createElement('p');
        quantityElement.textContent = item.quantity;
        ticketContainer.appendChild(quantityElement);
    
        let priceElement = document.createElement('p');
        priceElement.textContent = item.price * item.quantity.toFixed(2);
        ticketContainer.appendChild(priceElement);
    
        cartItemsContainer.appendChild(ticketContainer);
    
        totalPrice += item.price * item.quantity;
    });

    totalPriceElement.textContent = `€${totalPrice.toFixed(2)}`;

    var stripeKey = await fetchFromApi('/api/stripe/public-key');
    var stripe = Stripe(stripeKey.public_key);
    var elements = stripe.elements();
    var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    var idealBank = elements.create('idealBank', { style: style });
    idealBank.mount('#ideal-bank-element');

    idealBank.addEventListener('change', function (event) {
        var displayError = document.getElementById('ideal-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    const tickets = Array.from(combinedTickets.values()).map(item => ({
        name: item.name,
        quantity: item.quantity,
        price: Math.round(item.price * 100)
    }));

    const form = document.getElementById('payment-form');
    form.addEventListener('submit', async function (event) {
        event.preventDefault();

        const email = document.getElementById('email').value;
        const repeatEmail = document.getElementById('repeatEmail').value;
        const name = document.getElementById('name').value;

        if (!email || !repeatEmail || !name) {
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
            const response = await fetch('/api/stripe/create-payment-intent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    payment_method_type: 'ideal',
                    amount: Math.round(totalPrice * 100),
                    currency: 'eur',
                    tickets: tickets,
                }),
            });
    
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
    
            const data = await response.json();
    
            if (data.error) {
                const errorElement = document.getElementById('ideal-errors');
                errorElement.textContent = data.error.message;
            } else {
                const result = await stripe.confirmIdealPayment(data.clientSecret, {
                    payment_method: {
                        ideal: idealBank,
                    },
                    return_url: 'http://localhost/cart/checkout/confirmation',
                });
    
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
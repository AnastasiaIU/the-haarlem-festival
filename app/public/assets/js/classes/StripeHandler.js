import { fetchFromApi } from '../main.js';

export class StripeHandler {
    constructor() {
        this.stripe = null;
        this.idealBank = null;
    }

    async init() {
        const stripeKey = await fetchFromApi('/api/stripe/public-key');
        this.stripe = Stripe(stripeKey.public_key);
        const elements = this.stripe.elements();
        const style = {
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

        this.idealBank = elements.create('idealBank', { style: style });
        this.idealBank.mount('#ideal-bank-element');

        this.idealBank.addEventListener('change', function (event) {
            const displayError = document.getElementById('ideal-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
    }

    async createPayment(amount, tickets) {
        try {
            const response = await fetch('/api/stripe/create-payment-intent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    amount: amount,
                    tickets: tickets,
                }),
            });
    
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
    
            return await response.json();
        } catch (error) {
            console.error('Error posting to Stripe:', error);
            throw error;
        }
    }

    async confirmPayment(clientSecret) {
        return await this.stripe.confirmIdealPayment(clientSecret, {
            payment_method: {
                ideal: this.idealBank,
            },
            return_url: 'http://localhost/cart/checkout/confirmation',
        });
    }
}
import { fetchFromApi } from './main.js';

document.addEventListener('DOMContentLoaded', async function () {
    const orderNumberHolder = document.getElementById('order-number');
    if (orderNumberHolder) {
        const response = await fetchFromApi('/api/order-confirmation/code');
        orderNumberHolder.textContent = response.code;
    } else {
        console.error('Element with class "order-number" not found.');
    }
});
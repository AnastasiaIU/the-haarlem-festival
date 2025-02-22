import { ShoppingCart } from './classes/ShoppingCart.js';

const cart = new ShoppingCart();

document.addEventListener('DOMContentLoaded', function() {
    cart.addItem({ id: 1, code: 1, name: 'English Tour', date: 'Friday, July 25th, 2025', time: '23:00-00:30', price: 40.00, type: 'History Stroll', path: '/assets/images/history-stroll.jpg' });
    cart.addItem({ id: 2, code: 2, name: 'Hardwell at Jopenkerk', date: 'Friday, July 25th, 2025', time: '23:00-00:30', price: 20.00, type: 'DANCE!', path: '/assets/images/dance.jpg' });
    cart.addItem({ id: 3, code: 2, name: 'Hardwell at Jopenkerk', date: 'Friday, July 25th, 2025', time: '23:00-00:30', price: 20.00, type: 'DANCE!', path: '/assets/images/dance.jpg' });
});
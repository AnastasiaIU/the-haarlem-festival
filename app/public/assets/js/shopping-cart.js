import { ShoppingCart } from './classes/ShoppingCart.js';
import { Ticket } from './classes/Ticket.js';

const cart = new ShoppingCart();

document.addEventListener('DOMContentLoaded', function() {
    const ticket1 = new Ticket(1, 1, 'English Tour', 'Friday, July 25th, 2025', '23:00-00:30', 40.00, 'History Stroll', '/assets/images/history-stroll.jpg');
    const ticket2 = new Ticket(2, 2, 'Hardwell at Jopenkerk', 'Friday, July 25th, 2025', '23:00-00:30', 20.00, 'DANCE!', '/assets/images/dance.jpg');
    const ticket3 = new Ticket(3, 2, 'Hardwell at Jopenkerk', 'Friday, July 25th, 2025', '23:00-00:30', 20.00, 'DANCE!', '/assets/images/dance.jpg');
    
    cart.addItem(ticket1);
    cart.addItem(ticket2);
    cart.addItem(ticket3);
});
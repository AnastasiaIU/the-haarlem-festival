import { ShoppingCart } from './classes/ShoppingCart.js';
import { Ticket } from './classes/Ticket.js';

const cart = new ShoppingCart();

document.addEventListener('DOMContentLoaded', function () {
    const ticket1 = new Ticket(1, 1, 'English Tour', 'Friday, July 25th, 2025', '23:00-00:30', 40.00, 'History Stroll', '/assets/images/history-stroll.jpg', 'Family Ticket (4 person)');
    const ticket2 = new Ticket(2, 2, 'Hardwell at Jopenkerk', 'Friday, July 25th, 2025', '23:00-00:30', 20.00, 'DANCE!', '/assets/images/dance.jpg');
    const ticket3 = new Ticket(3, 2, 'Hardwell at Jopenkerk', 'Friday, July 25th, 2025', '23:00-00:30', 20.00, 'DANCE!', '/assets/images/dance.jpg');
    const ticket4 = new Ticket(4, 1, 'English Tour', 'Friday, July 25th, 2025', '23:00-00:30', 40.00, 'History Stroll', '/assets/images/history-stroll.jpg', 'Individual Ticket');
    const ticket5 = new Ticket(5, 3, 'Reservation at Ratatouille Food and Wine', 'Saturday, July 26th, 2025', '19:00-21:00', 10, 'Yummy!', '/assets/images/yummy.jpg', 'Adults');
    const ticket6 = new Ticket(5, 3, 'Reservation at Ratatouille Food and Wine', 'Saturday, July 26th, 2025', '19:00-21:00', 0, 'Yummy!', '/assets/images/yummy.jpg', 'Kids');

    cart.addItem(ticket1);
    cart.addItem(ticket2);
    cart.addItem(ticket3);
    cart.addItem(ticket4);
    cart.addItem(ticket5);
    cart.addItem(ticket6);
});
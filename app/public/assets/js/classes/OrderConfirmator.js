import { ShoppingCart } from './ShoppingCart.js';
import { Booking } from './Booking.js';
import { Reservation } from './Reservation.js';

export class OrderConfirmator {
    constructor() {
        this.shoppingCart = ShoppingCart.getInstance();
        this.bookings = [];
        this.reservations = [];
    }

    async init() {
        const paymentStatus = this.getPaymentStatus();
        if (paymentStatus === 'succeeded') {
            await this.processOrder();
        }
    }

    getPaymentStatus() {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get('redirect_status');
    }

    getOrderItems() {
        return Array.from(this.shoppingCart.items.values()).map((orderItemGroup) => {
            const item = orderItemGroup[0];
            const quantity = orderItemGroup.length;
            return {
                quantity: quantity,
                type: item.type,
                subType: item.subType === '' ? null : item.subType,
                ticketId: item.id,
                date: item.date,
                time: item.time,
            };
        });
    }

    async processOrder() {
        const orderItems = this.getOrderItems();
        this.createBookings(orderItems);
        await this.processRestaurantBookings(orderItems);

        try {
            const response = await this.postBookings();
            const data = await response.json();
            this.displayConfirmation(data);
            this.shoppingCart.clearCart();
        } catch (error) {
            console.error('Error posting to API:', error);
            throw error;
        }
    }

    createBookings(orderItems) {
        orderItems.forEach((orderItem) => {
            if (orderItem.type !== 'reservation') {
                const booking = new Booking(orderItem.type, orderItem.subType, orderItem.ticketId, orderItem.quantity);
                this.bookings.push(booking);
            }
        });
    }

    async processRestaurantBookings(orderItems) {
        this.createReservations(orderItems);

        if(this.reservations.length === 0) {
            return;
        }
        
        try {
            const response = await this.postReservations();
            const reservationIds = await response.json();
            this.createRestaurantBookings(reservationIds, orderItems);
        } catch (error) {
            console.error('Error posting to API:', error);
            throw error;
        }
    }

    createReservations(orderItems) {
        const reservationMap = new Map();

        orderItems.forEach((orderItem) => {
            if (orderItem.type === 'reservation') {
                const dateTime = `${orderItem.date}T${orderItem.time}`;;
                const key = `${orderItem.ticketId}-${dateTime}`;

                if (!reservationMap.has(key)) {
                    reservationMap.set(key, {
                        restaurantId: orderItem.ticketId,
                        dateTime: dateTime,
                        kids: 0,
                        adults: 0,
                        comment: orderItem.comment || '',
                    });
                }

                const reservationEntry = reservationMap.get(key);
                if (orderItem.subType === 'Kids') {
                    reservationEntry.kids += orderItem.quantity;
                } else if (orderItem.subType === 'Adults') {
                    reservationEntry.adults += orderItem.quantity;
                }
            }
        });

        reservationMap.forEach((reservationData) => {
            const reservation = new Reservation(
                reservationData.restaurantId,
                reservationData.dateTime,
                reservationData.adults,
                reservationData.kids,
                reservationData.comment
            );
            this.reservations.push(reservation);
        });
    }

    createRestaurantBookings(reservationIds,orderItems) {
            const reservationMap = new Map();
        let reservationIndex = 0;

        orderItems.forEach((orderItem) => {
            if (orderItem.type === 'reservation') {
                const dateTime = `${orderItem.date}T${orderItem.time}`;
                const key = `${orderItem.ticketId}-${dateTime}`;
    
                if (!reservationMap.has(key)) {
                    reservationMap.set(key, reservationIds[reservationIndex]);
                    reservationIndex++;
                }
    
                const booking = new Booking(
                    orderItem.type,
                    orderItem.subType,
                    reservationMap.get(key),
                    orderItem.quantity
                );
    
                this.bookings.push(booking);
            }
        });
    }

    async postBookings() {
        return await fetch('/api/bookings', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                bookings: this.bookings,
                receivingEmail: localStorage.getItem('email'),
            }),
        });
    }

    async postReservations() {
        return await fetch('http://localhost/api/reservation', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                reservations: this.reservations,
            }),
        })
    }

    displayConfirmation(data) {
        const orderNumberHolder = document.getElementById('order-number');
        const orderConfirmationHolder = document.getElementById('confirmation-message');

        orderNumberHolder.textContent = data.order_number;
        orderConfirmationHolder.textContent =`A confiramation will be sent to you at ${data.receiving_email} with your tickets.`;
    }
}
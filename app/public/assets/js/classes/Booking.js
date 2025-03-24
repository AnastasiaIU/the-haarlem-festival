export class Booking {
    constructor(id, orderNumber, userId, name, receivingEmail, ticketType, ticketId, quantity) {
        this.id = id;
        this.orderNumber = orderNumber;
        this.userId = userId;
        this.receivingEmail = receivingEmail;
        this.ticketType = ticketType;
        this.ticketId = ticketId;
        this.quantity = quantity;
    }

    async createBooking() {
        try {
            const response = await fetch('/api/booking', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    receivingEmail: this.receivingEmail,
                    ticketType: this.ticketType,
                    ticketId: this.ticketId,
                    quantity: this.quantity,
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
}
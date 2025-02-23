import { Ticket } from "./Ticket.js";

export class ShoppingCart {
    constructor() {
        this.items = new Map();
        this.totalPrice = 0;
    }

    addItem(newItem) {
        if (this.items.has(newItem.code)) {
            this.items.get(newItem.code).push(newItem);
        } else {
            this.items.set(newItem.code, [newItem]);
        }
        this.updateTotalPrice();
        this.updateTotalPriceInDOM();
        this.updateCartUI();
    }

    removeItem(itemCode) {
        if (this.items.has(itemCode)) {
            const tickets = this.items.get(itemCode);
            tickets.pop();
            if (tickets.length === 0) {
                this.items.delete(itemCode);
            }
            this.updateTotalPrice();
            this.updateTotalPriceInDOM();
            this.updateCartUI();
        }
    }

    updateQuantity(itemCode, quantity) {
        if (this.items.has(itemCode)) {
            const tickets = this.items.get(itemCode);
            if (quantity > 0) {
                const existingItem = tickets[0];
                const newItem = new Ticket(existingItem.id + 1, existingItem.code, existingItem.name, existingItem.date, existingItem.time, existingItem.price, existingItem.type, existingItem.path);
                tickets.push(newItem);
            } else {
                tickets.pop();
                if (tickets.length === 0) {
                    this.items.delete(itemCode);
                }
            }
            this.updateTotalPrice();
            this.updateTotalPriceInDOM();
            this.updateCartUI();
            console.log(this.items);
        }
    }

    updateTotalPrice() {
        this.totalPrice = Array.from(this.items.values()).flat().reduce((total, item) => total + item.price, 0);
    }

    getTotalPrice() {
        return this.totalPrice;
    }

    getItems() {
        return Array.from(this.items.values()).flat();
    }

    getQuantity(itemCode) {
        return this.items.has(itemCode) ? this.items.get(itemCode).length : 0;
    }

    updateTotalPriceInDOM() {
        const totalPriceElement = document.getElementById('total-price');
        if (totalPriceElement) {
            totalPriceElement.textContent = `${this.totalPrice.toFixed(2)}`;
        }
    }

    updateCartUI() {
        const cartItemsContainer = document.getElementById('cart-items');
        cartItemsContainer.innerHTML = '';

        this.items.forEach((tickets, code) => {
            const item = tickets[0];
            const quantity = tickets.length;
            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item');
            cartItem.innerHTML = `
            <img src="${item.path}" alt="${item.name}">
            <div>
                <p class="event-type">${item.type}</p>
                <p class="event-name">${item.name}</p>
                <p class="event-date">${item.date}</p>
                <p class="event-date">${item.time}</p>
            </div>
            <div class="quantity-controls">
                <button class="decrease-quantity">-</button>
                <span class="quantity">${quantity}</span>
                <button class="increase-quantity">+</button>
            </div>
            <div>€${(item.price).toFixed(2)}</div>
            <div>€${(item.price * quantity).toFixed(2)}</div>
            <button class="remove-item">Remove</button>
            `;
            cartItemsContainer.appendChild(cartItem);

            cartItem.querySelector('.decrease-quantity').addEventListener('click', () => {
                this.updateQuantity(item.code, -1);
            });
            cartItem.querySelector('.increase-quantity').addEventListener('click', () => {
                this.updateQuantity(item.code, 1);
            });
            cartItem.querySelector('.remove-item').addEventListener('click', () => {
                this.removeItem(item.code);
            });
        });

        this.updateTotalPriceInDOM();
    }
}
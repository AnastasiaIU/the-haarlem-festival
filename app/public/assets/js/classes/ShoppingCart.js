import { Ticket } from "./Ticket.js";

export class ShoppingCart {
    constructor() {
        this.items = new Map();
        this.totalPrice = 0;
    }

    addItem(newItem) {
        const key = newItem.id;
        if (this.items.has(key)) {
            this.items.get(key).push(newItem);
        } else {
            this.items.set(key, [newItem]);
        }
        this.updateTotalPrice();
        this.updateTotalPriceInDOM();
        this.updateCartUI();
    }

    removeItem(itemCode) {
        const keysToRemove = Array.from(this.items.keys()).filter(key => this.items.get(key)[0].code === itemCode);
        keysToRemove.forEach(key => this.items.delete(key));
        this.updateTotalPrice();
        this.updateTotalPriceInDOM();
        this.updateCartUI();
    }

    updateQuantity(itemId, change) {
        if (this.items.has(itemId)) {
            const tickets = this.items.get(itemId);
            if (change > 0) {
                const existingItem = tickets[0];
                const newItem = new Ticket(existingItem.id + 1, existingItem.code, existingItem.name, existingItem.date, existingItem.time, existingItem.price, existingItem.type, existingItem.path, existingItem.subType);
                tickets.push(newItem);
            } else {
                tickets.pop();
                if (tickets.length === 0) {
                    this.items.delete(itemId);
                }
            }
            this.updateTotalPrice();
            this.updateTotalPriceInDOM();
            this.updateCartUI();
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
        return Array.from(this.items.values()).flat().filter(item => item.code === itemCode).length;
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

        const groupedItems = new Map();

        this.items.forEach((tickets) => {
            const item = tickets[0];
            const code = item.code;
            const subType = item.subType;
            if (!groupedItems.has(code)) {
                groupedItems.set(code, new Map());
            }
            if (!groupedItems.get(code).has(subType)) {
                groupedItems.get(code).set(subType, []);
            }
            groupedItems.get(code).get(subType).push(...tickets);
        });

        groupedItems.forEach((subTypeGroups, code) => {
            const item = Array.from(subTypeGroups.values())[0][0];
            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item');
            cartItem.innerHTML = `
                <img src="${item.path}" alt="${item.name}" class="item-image">
                <div class="item-info">
                    <p class="event-type">${item.type}</p>
                    <p class="event-name">${item.name}</p>
                    <p class="event-date">${item.date}</p>
                    <p class="event-time">${item.time}</p>
                </div>
                <div class="d-flex flex-column">
                    ${Array.from(subTypeGroups.entries()).map(([subType, tickets]) => {
                if (subType !== null) {
                    return `
                                <div class="subtype-quantity">
                                    <p class="text-center m-0">${subType}</p>
                                </div>
                            `;
                }
            }).join('')}
                </div>
                <div class="d-flex flex-column">
                    ${Array.from(subTypeGroups.entries()).map(([subType, tickets]) => {
                const quantity = tickets.length;
                return `
                                <div class="quantity-controls">
                                    <button class="decrease-quantity" data-id="${tickets[0].id}">-</button>
                                    <span class="quantity">${quantity}</span>
                                    <button class="increase-quantity" data-id="${tickets[0].id}">+</button>
                                </div>
                        `;
            }).join('')}
                </div>
                <div class="d-flex flex-column">
                    ${Array.from(subTypeGroups.entries()).map(([subType, tickets]) => {
                const price = tickets[0].price;
                return `
                                <div class="subtype-quantity">
                                    <p class="m-0">€${parseFloat(price).toFixed(2)}</p>
                                </div>
                        `;
            }).join('')}
                </div>
                <div class="item-total">€${(Array.from(subTypeGroups.values()).reduce((total, tickets) => total + (tickets[0].price * tickets.length), 0)).toFixed(2)}</div>
                <button class="remove-item" data-code="${code}">Remove</button>
            `;
            cartItemsContainer.appendChild(cartItem);

            cartItem.querySelectorAll('.decrease-quantity').forEach(button => {
                button.addEventListener('click', () => {
                    const itemId = button.getAttribute('data-id');
                    this.updateQuantity(parseInt(itemId), -1);
                });
            });

            cartItem.querySelectorAll('.increase-quantity').forEach(button => {
                button.addEventListener('click', () => {
                    const itemId = button.getAttribute('data-id');
                    this.updateQuantity(parseInt(itemId), 1);
                });
            });

            cartItem.querySelector('.remove-item').addEventListener('click', () => {
                const itemCode = cartItem.querySelector('.remove-item').getAttribute('data-code');
                this.removeItem(parseInt(itemCode));
            });
        });

        this.updateTotalPriceInDOM();
    }

    getCombineTickets(cart) {
        const combinedTickets = new Map();

        cart.forEach(tickets => {
            tickets.forEach(item => {
                const key = `${item.name}-${item.subType}`;
                if (combinedTickets.has(key)) {
                    combinedTickets.get(key).quantity += 1;
                } else {
                    combinedTickets.set(key, { ...item, quantity: 1 });
                }
            });
        });

        return combinedTickets;
    }

    renderTickets(combinedTickets, cartItemsContainer, totalPriceElement) {
        let totalPrice = 0;
        
        combinedTickets.forEach(item => {
            const ticketContainer = document.createElement('div');
            ticketContainer.classList.add('cart-item-c');

            const nameElement = document.createElement('p');
            nameElement.textContent = item.name;
            ticketContainer.appendChild(nameElement);

            const quantityElement = document.createElement('p');
            quantityElement.textContent = item.quantity;
            ticketContainer.appendChild(quantityElement);

            const priceElement = document.createElement('p');
            priceElement.textContent = (item.price * item.quantity).toFixed(2);
            ticketContainer.appendChild(priceElement);

            cartItemsContainer.appendChild(ticketContainer);

            totalPrice += item.price * item.quantity;
        });

        totalPriceElement.textContent = `€${totalPrice.toFixed(2)}`;

        return totalPrice;
    }
}
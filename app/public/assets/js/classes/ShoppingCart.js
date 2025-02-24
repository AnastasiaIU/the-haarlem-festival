import { Ticket } from "./Ticket.js";

export class ShoppingCart {
    constructor() {
        this.items = new Map();
        this.totalPrice = 0;
    }

    addItem(newItem) {
        const key = `${newItem.code}-${newItem.subType}-${newItem.price}`;
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
        const keysToRemove = Array.from(this.items.keys()).filter(key => key.startsWith(itemCode));
        keysToRemove.forEach(key => this.items.delete(key));
        this.updateTotalPrice();
        this.updateTotalPriceInDOM();
        this.updateCartUI();
    }

    updateQuantity(itemCode, subType, price, change) {
        const key = `${itemCode}-${subType}-${price}`;
        if (this.items.has(key)) {
            const tickets = this.items.get(key);
            if (change > 0) {
                const existingItem = tickets[0];
                const newItem = new Ticket(existingItem.id + 1, existingItem.code, existingItem.name, existingItem.date, existingItem.time, existingItem.price, existingItem.type, existingItem.path, existingItem.subType);
                tickets.push(newItem);
            } else {
                tickets.pop();
                if (tickets.length === 0) {
                    this.items.delete(key);
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
        return Array.from(this.items.keys()).filter(key => key.startsWith(itemCode)).reduce((total, key) => total + this.items.get(key).length, 0);
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

        this.items.forEach((tickets, key) => {
            const [code, subType, price] = key.split('-');
            if (!groupedItems.has(code)) {
                groupedItems.set(code, []);
            }
            groupedItems.get(code).push({ subType, price, tickets });
        });

        groupedItems.forEach((subTypeGroups, code) => {
            const item = subTypeGroups[0].tickets[0];
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
                    ${subTypeGroups.map(({ subType }) => {
                        return `
                            <div class="subtype-quantity">
                                <p class="text-center m-0">${subType}</p>
                            </div>
                        `;
                    }).join('')}
                </div>
                <div class="d-flex flex-column">
                        ${subTypeGroups.map(({ subType, price, tickets }) => {
                            const quantity = tickets.length;
                            return `
                                <div class="quantity-controls">
                                    <button class="decrease-quantity" data-code="${code}" data-subtype="${subType}" data-price="${price}">-</button>
                                    <span class="quantity">${quantity}</span>
                                    <button class="increase-quantity" data-code="${code}" data-subtype="${subType}" data-price="${price}">+</button>
                                </div>
                            `;
                    }).join('')}
                </div>
                <div class="d-flex flex-column">
                    ${subTypeGroups.map(({ price }) => {
                        return `
                            <div class="subtype-quantity">
                                <p class="m-0">€${parseFloat(price).toFixed(2)}</p>
                            </div>
                        `;
                    }).join('')}
                </div>
                <div class="item-total">€${(subTypeGroups.reduce((total, { price, tickets }) => total + (price * tickets.length), 0)).toFixed(2)}</div>
                <button class="remove-item" data-code="${code}">Remove</button>
            `;
            cartItemsContainer.appendChild(cartItem);

            cartItem.querySelectorAll('.decrease-quantity').forEach(button => {
                button.addEventListener('click', () => {
                    const itemCode = button.getAttribute('data-code');
                    const subType = button.getAttribute('data-subtype');
                    const price = parseFloat(button.getAttribute('data-price'));
                    this.updateQuantity(itemCode, subType, price, -1);
                });
            });

            cartItem.querySelectorAll('.increase-quantity').forEach(button => {
                button.addEventListener('click', () => {
                    const itemCode = button.getAttribute('data-code');
                    const subType = button.getAttribute('data-subtype');
                    const price = parseFloat(button.getAttribute('data-price'));
                    this.updateQuantity(itemCode, subType, price, 1);
                });
            });

            cartItem.querySelector('.remove-item').addEventListener('click', () => {
                const itemCode = cartItem.querySelector('.remove-item').getAttribute('data-code');
                this.removeItem(itemCode);
            });
        });

        this.updateTotalPriceInDOM();
    }
}
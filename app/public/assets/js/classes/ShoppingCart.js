// filepath: /d:/Coding/Inholland/Year 2/term 3/HaarlemFestival/the-haarlem-festival/resources/js/classes/ShoppingCart.js

export class ShoppingCart {
    constructor() {
        this.items = [];
        this.itemQuantities = new Map();
        this.totalPrice = 0;
    }

    addItem(newItem) {
        const existingItem = this.items.find(item => item.code === newItem.code);
        if (existingItem) {
            this.itemQuantities.set(newItem.code, (this.itemQuantities.get(newItem.code) || 1) + (newItem.quantity || 1));
        } else {
            newItem.quantity = newItem.quantity || 1;
            this.items.push(newItem);
            this.itemQuantities.set(newItem.code, newItem.quantity);
        }
        this.updateTotalPrice();
        this.updateTotalPriceInDOM();
        this.updateCartUI();
    }

    removeItem(itemCode) {
        this.items = this.items.filter(item => item.code !== itemCode);
        this.itemQuantities.delete(itemCode);
        this.updateTotalPrice();
        this.updateTotalPriceInDOM();
        this.updateCartUI();
    }

    updateQuantity(itemCode, quantity) {
        if (this.itemQuantities.has(itemCode)) {
            const newQuantity = (this.itemQuantities.get(itemCode) || 1) + quantity;
            if (newQuantity < 1) {
                this.removeItem(itemCode);
            } else {
                this.itemQuantities.set(itemCode, newQuantity);
                this.updateTotalPrice();
                this.updateTotalPriceInDOM();
                this.updateCartUI();
            }
        }
    }

    updateTotalPrice() {
        this.totalPrice = this.items.reduce((total, item) => total + item.price * (this.itemQuantities.get(item.code) || 1), 0);
    }

    getTotalPrice() {
        return this.totalPrice;
    }

    getItems() {
        return this.items;
    }

    getQuantity(itemType) {
        return this.items
            .filter(item => item.type === itemType)
            .reduce((total, item) => total + (this.itemQuantities.get(item.code) || 1), 0);
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

        this.items.forEach(item => {
            const quantity = this.itemQuantities.get(item.code) || 1;
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
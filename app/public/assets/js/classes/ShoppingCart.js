import { CartItem } from "./CartItem.js";

export class ShoppingCart {
    static instance = null;

    constructor() {
        if (ShoppingCart.instance) {
            return ShoppingCart.instance;
        }

        this.items = this.loadCartFromStorage(); // Load items from localStorage
        this.totalPrice = 0; // Total price of all items in the cart
        this.updateTotalPrice(); // Calculate the total price

        ShoppingCart.instance = this;
    }

    getTotalPrice() {
        return this.totalPrice;
    }

    /**
     * Static method to get the singleton instance of the ShoppingCart class.
     * @returns {ShoppingCart} The single instance of the ShoppingCart class.
     */
    static getInstance() {
        if (!ShoppingCart.instance) {
            ShoppingCart.instance = new ShoppingCart();
        }
        return ShoppingCart.instance;
    }

    /**
     * Adds an item to the shopping cart.
     * If the item already exists, it increases the quantity.
     *
     * @param {CartItem} newItem - The item to add to the cart.
     */
    addItem(newItem) {
        const key = newItem.id;

        // Check if the item already exists in the cart
        if (this.items.has(key)) {
            this.items.get(key).push(newItem); // Add another instance of the item
        } else {
            this.items.set(key, [newItem]); // Add the item as a new entry
        }

        this.saveCartToStorage(); // Save the updated cart to localStorage
        this.updateTotalPrice(); // Update the total price
    }

    /**
     * Removes an item from the shopping cart by its ID.
     *
     * @param {number} itemId - The ID of the item to remove.
     */
    removeItem(itemId) {
        if (this.items.has(itemId)) {
            this.items.delete(itemId); // Remove the item from the cart
            this.saveCartToStorage(); // Save the updated cart to localStorage
            this.updateTotalPrice(); // Update the total price
        }
    }

    /**
     * Updates the quantity of an item in the cart.
     *
     * @param {number} itemId - The ID of the item to update.
     * @param {number} change - The change in quantity (+1 or -1).
     */
    updateQuantity(itemId, change) {
        if (this.items.has(itemId)) {
            const tickets = this.items.get(itemId);

            if (change > 0) {
                // Increase quantity
                const existingItem = tickets[0];
                const newItem = new CartItem(
                    existingItem.id,
                    existingItem.name,
                    `${existingItem.date}T${existingItem.time}`,
                    existingItem.price,
                    existingItem.type,
                    existingItem.path,
                    existingItem.subType
                );
                tickets.push(newItem);
            } else {
                // Decrease quantity
                tickets.pop();
                if (tickets.length === 0) {
                    this.items.delete(itemId); // Remove the item if quantity is 0
                }
            }

            this.saveCartToStorage(); // Save the updated cart to localStorage
            this.updateTotalPrice(); // Update the total price
        }
    }

    /**
     * Updates the total price of the cart.
     */
    updateTotalPrice() {
        this.totalPrice = Array.from(this.items.values())
            .flat()
            .reduce((total, item) => total + item.price, 0);
    }

    clearCart() {
        this.items.clear();
        this.saveCartToStorage();
        this.updateTotalPrice();
    }

    /**
     * Saves the cart to localStorage.
     */
    saveCartToStorage() {
        const cartArray = Array.from(this.items.entries()).map(([key, value]) => [key, value]);
        localStorage.setItem('shoppingCart', JSON.stringify(cartArray));
    }

    /**
     * Loads the cart from localStorage.
     * @returns {Map} A map of items loaded from localStorage.
     */
    loadCartFromStorage() {
        const storedCart = localStorage.getItem('shoppingCart');
        if (storedCart) {
            const parsedCart = JSON.parse(storedCart);
            return new Map(parsedCart.map(([key, value]) => [key, value.map(item => new CartItem(
                item.id,
                item.name,
                `${item.date}T${item.time}`,
                item.price,
                item.type,
                item.path,
                item.subType
            ))]));
        }
        return new Map();
    }

    /**
     * Retrieves all items in the cart.
     * @returns {Array} An array of all items in the cart.
     */
    getItems() {
        return Array.from(this.items.values()).flat();
    }

    /**
     * Renders the cart items in the UI.
     *
     * @param {HTMLElement} cartItemsContainer - The container for cart items.
     * @param {HTMLElement} totalPriceElement - The element for displaying the total price.
     */
    renderCart(cartItemsContainer, totalPriceElement) {
        cartItemsContainer.innerHTML = '';

        this.items.forEach((tickets, key) => {
            const item = tickets[0];
            const quantity = tickets.length;

            const cartItemElement = document.createElement('div');
            cartItemElement.classList.add('cart-item');
            cartItemElement.innerHTML = `
                <img src="./assets/images/${item.path}" alt="${item.name}" class="item-image">
                <div class="item-info">
                    <p class="event-type">${item.type}</p>
                    <p class="event-name">${item.name}</p>
                    <p class="event-date">${item.date.split('-').reverse().join('-')}</p>
                    <p class="event-time">${item.time.slice(0, 5)}</p>
                </div>
                <div>
                    <p>${item.subType}</p>
                </div>
                <div class="quantity-controls">
                    <button class="decrease-quantity" data-id="${key}">-</button>
                    <span class="quantity">${quantity}</span>
                    <button class="increase-quantity" data-id="${key}">+</button>
                </div>
                <p class="item-price">€ ${item.price.toFixed(2)}</p>
                <p class="item-price">€ ${(item.price * quantity).toFixed(2)}</p>
                <button class="remove-item" data-id="${key}">Remove</button>
            `;

            cartItemsContainer.appendChild(cartItemElement);

            // Add event listeners for quantity buttons and remove button
            cartItemElement.querySelector('.decrease-quantity').addEventListener('click', () => {
                this.updateQuantity(parseInt(key), -1);
                this.renderCart(cartItemsContainer, totalPriceElement);
            });

            cartItemElement.querySelector('.increase-quantity').addEventListener('click', () => {
                this.updateQuantity(parseInt(key), 1);
                this.renderCart(cartItemsContainer, totalPriceElement);
            });

            cartItemElement.querySelector('.remove-item').addEventListener('click', () => {
                this.removeItem(parseInt(key));
                this.renderCart(cartItemsContainer, totalPriceElement);
            });
        });

        // Update the total price in the UI
        totalPriceElement.textContent = `€${this.totalPrice.toFixed(2)}`;
    }

    renderCheckout(checkoutItemsContainer, totalPriceElement) {
        checkoutItemsContainer.innerHTML = '';

        this.items.forEach((tickets) => {
            const item = tickets[0];
            const quantity = tickets.length;

            const cartItemElement = document.createElement('div');
            cartItemElement.classList.add('cart-item-c');
            cartItemElement.innerHTML = `
                <div class="d-flex flex-column">
                    <strong>${item.type}</strong>
                    <strong>${item.name}</strong>
                    <p class="m-0 text-start">${item.date.split('-').reverse().join('-')}</p>
                    <p class="m-0">${item.time.slice(0, 5)}</p>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <p>${quantity}</p>
                </div>
                <div class="d-flex align-items-center justify-content-center">
                    <p>€ ${(item.price * quantity).toFixed(2)}</p>
                </div>
            `;

            checkoutItemsContainer.appendChild(cartItemElement);
        });

        totalPriceElement.textContent = `€ ${this.totalPrice.toFixed(2)}`;
    }
}
import { ShoppingCart } from "./classes/ShoppingCart.js";

document.addEventListener("DOMContentLoaded", () => {
    const shoppingCart = ShoppingCart.getInstance();

    const cartItemsContainer = document.getElementById("cart-items");
    const totalPriceElement = document.getElementById("total-price");

    shoppingCart.renderCart(cartItemsContainer, totalPriceElement);

    const checkoutButton = document.getElementById("checkoutButton");

    checkoutButton.addEventListener("click", () => {
        if (shoppingCart.getItems().length !== 0) {
            window.location.href = "/cart/checkout";
        }
    });
});
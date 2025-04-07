import { OrderConfirmator } from "./classes/OrderConfirmator.js";

document.addEventListener('DOMContentLoaded', async () => {
    const orderConfirmator = new OrderConfirmator();
    await orderConfirmator.init();
});
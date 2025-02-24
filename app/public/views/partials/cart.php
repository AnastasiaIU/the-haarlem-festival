<main class="container-fluid d-flex flex-column flex-grow-1 p-0">
    <div class="cart-view-container">
        <div class="d-flex justify-content-between align-items-center">
            <h1>My Personal Plan</h1>
            <div class="d-flex justify-content-between align-items-center">
                <strong class="mx-5">Share the plan</strong>
                <button class="btn btn-primary">Copy the link</button>
            </div>
        </div>
        <hr class="my-4" style="border-color: black;">
        <div class="cart-item-headers">
            <strong>Event Details</strong>
            <strong></strong>
            <strong></strong>
            <strong>Quantity</strong>
            <strong>Price</strong>
            <strong>Total</strong>
        </div>
        <div id="cart-items">
        </div>
        <hr class="my-4" style="border-color: black;">
        <div class="d-flex justify-content-between align-items-center">
            <p class="w-50">* This is the reservation fee of € 10,00 per person. Reservation is mandatory. The courses price is not included in this price. This fee will be deducted from the final check on visiting the restaurant. The reservation fee is non-refundable.</p>
            <p>
                <strong>Total:</strong>
                <span id="total-price">0.00</span>
            </p>
        </div>
        <div class="d-flex justify-content-end">
            <button class="btn btn-primary">Proceed to checkout</button>
        </div>
    </div>
</main>

<script type="module" src="/assets/js/shopping-cart.js"></script>
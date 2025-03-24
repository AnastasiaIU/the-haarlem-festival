<div class="cart-view-container d-flex flex-row">
    <div class="payment-container">
        <h1>My Details</h1>
        <hr class="my-4" style="border-color: black;">
        <p>This information is used to issue tickets and send them to the provided email.</p>
        <div>
            <div class="my-3 input-container">
                <label for="email">Email:*</label>
                <input class="input-field" type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="my-3 input-container">
                <label for="email">Repeat email:*</label>
                <input class="input-field" type="email" id="repeatEmail" name="repeatEmail" placeholder="Repeat your email" required>
            </div>
            <div class="my-3 input-container">
                <label for="name">Name:*</label>
                <input class="input-field" type="text" id="name" name="name" placeholder="Enter your name" required>
            </div>
        </div>
        <h3>Payment</h3>
        <hr class="my-4" style="border-color: black;">
        <p>Choose payment method.</p>
        <form id="payment-form" method="post">
            <div id="ideal-bank-element">
                <!-- A Stripe iDEAL Bank Element will be inserted here. -->
            </div>
            <div id="ideal-errors" role="alert"></div>
            <button type="submit">Pay with iDEAL</button>
        </form>
    </div>
    <aside class="aside-container ms-auto">
        <div class="personal-plan-background">
            <div class="plan-container">
                <h3>My Personal Plan</h3>
                <div class="plan-headers">
                    <strong>Events</strong>
                    <strong>Quantity</strong>
                    <strong>Price</strong>
                </div>
                <div id="cart-items">

                </div>
                <hr class="my-5" style="border-color: black;">
                <div class="d-flex total-price">
                    <strong class="ms-auto mx-5">Total:</strong>
                    <span id="total-price"></span>
                </div>
            </div>
        </div>
    </aside>
</div>

<script src="https://js.stripe.com/v3/"></script>
<!-- <script src="https://www.paypal.com/sdk/js?client-id=YOUR_PAYPAL_CLIENT_ID&currency=USD"></script> -->
<script type="module" src="../../assets/js/checkout.js"></script>
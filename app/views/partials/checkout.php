<div class="cart-view-container d-flex flex-row">
    <div class="payment-container">
        <h1>My Details</h1>
        <hr class="my-4" style="border-color: black;">
        <p>This information is used to issue tickets and send them to the provided email.</p>
        <div>
            <p id="errorMessage" class="error-message">
            </p>
            <div class="my-3 input-container">
                <label for="email">Email:*</label>
                <input class="input-field" type="email" id="email" name="email" placeholder="Enter your email">
            </div>
            <div class="my-3 input-container">
                <label for="email">Repeat email:*</label>
                <input class="input-field" type="email" id="repeatEmail" name="repeatEmail" placeholder="Repeat your email">
            </div>
        </div>
        <h3>Payment</h3>
        <hr class="my-4" style="border-color: black;">
        <div class="d-flex align-items-center payment-method">
            <div class="custom-radio">
                <input type="radio" name="payment-method" value="ideal" class="payment-radio-button" checked>
                <span class="radio-mark"></span>
            </div>
            <label class="fw-bold">iDEAL</label>
            <img src="../../assets/images/ideal-logo.svg" alt="iDEAL" class="payment-image ms-auto">
        </div>
        <form id="payment-form" method="post">
            <div id="ideal-bank-element" class="select-bank">
            </div>
            <div id="ideal-errors" class="error-message" role="alert"></div>
            <button type="submit" class="btn btn-primary">Pay with iDEAL</button>
        </form>
    </div>
    <aside class="aside-container ms-auto">
        <div class="personal-plan-background">
            <div class="plan-container">
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
<script type="module" src="../../assets/js/checkout.js"></script>
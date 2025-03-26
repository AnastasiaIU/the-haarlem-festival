<div id="bookingModal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Modal body text goes here.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>
<section class="book-card d-flex flex-column w-100 gap-4 gap-lg-2">
    <div>
        <h3 class="book-day h4 fw-bold mb-2"></h3>
        <div class="row row-cols-4 row-cols-md-5">
            <p class="col col-md-2 col-lg-2 fw-bold m-0">Start</p>
            <p class="col col-md-2 col-lg-2 fw-bold m-0">Duration</p>
            <p class="col col-md-4 col-lg-2 fw-bold m-0">Dinner price (Adult / Kids)</p>
            <p class="col col-md-3 col-lg-2 fw-bold m-0">Seats available</p>
        </div>
    </div>
    <div class="row row-cols-4 row-cols-md-5 align-items-center">
        <p class="col col-md-2 col-lg-2 start m-0"></p>
        <p class="col col-md-2 col-lg-2 duration m-0"></p>
        <p class="col col-md-4 col-lg-2 price m-0"></p>
        <p class="col col-md-2 col-lg-2 seats m-0"></p>
        <div class="col-12 col-md-2 col-lg-4 button p-0">
            <button class="btn btn-primary d-flex text-nowrap align-items-center gap-2 py-2 px-3" data-bs-toggle="modal" data-bs-target="#bookingModal">
                <span>Add to cart</span>
                <img src="/assets/images/shopping_cart_white.svg" alt="Shopping cart">
            </button>
        </div>
    </div>
</section>
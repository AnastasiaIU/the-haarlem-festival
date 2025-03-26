<div id="bookingModal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header pb-1">
                <h5 class="modal-title h4 fw-bold">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <p class="modal-time"></p>
                <div class="d-flex flex-column">
                    <p class="fw-bold">Pick number of adults</p>
                    <div class="d-flex gap-1 pb-3">
                        <input type="radio" class="btn-check" name="optionsAdult" id="optionAdult1" autocomplete="off" checked>
                        <label class="btn btn-people-amount" for="optionAdult1">1</label>

                        <input type="radio" class="btn-check" name="optionsAdult" id="optionAdult2" autocomplete="off">
                        <label class="btn btn-people-amount" for="optionAdult2">2</label>

                        <input type="radio" class="btn-check" name="optionsAdult" id="optionAdult3" autocomplete="off">
                        <label class="btn btn-people-amount" for="optionAdult3">3</label>

                        <input type="radio" class="btn-check" name="optionsAdult" id="optionAdult4" autocomplete="off">
                        <label class="btn btn-people-amount" for="optionAdult4">4</label>

                        <input type="radio" class="btn-check" name="optionsAdult" id="optionAdult5" autocomplete="off">
                        <label class="btn btn-people-amount" for="optionAdult5">5</label>

                        <input type="radio" class="btn-check" name="optionsAdult" id="optionAdult6" autocomplete="off">
                        <label class="btn btn-people-amount" for="optionAdult6">6</label>

                        <input type="radio" class="btn-check" name="optionsAdult" id="optionAdult7" autocomplete="off">
                        <label class="btn btn-people-amount" for="optionAdult7">7</label>

                        <input type="radio" class="btn-check" name="optionsAdult" id="optionAdult8" autocomplete="off">
                        <label class="btn btn-people-amount" for="optionAdult8">8</label>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    <p class="fw-bold">Pick number of children</p>
                    <div class="d-flex gap-1 pb-3">
                        <input type="radio" class="btn-check" name="optionsKids" id="optionKids0" autocomplete="off" checked>
                        <label class="btn btn-people-amount" for="optionKids0">0</label>

                        <input type="radio" class="btn-check" name="optionsKids" id="optionKids1" autocomplete="off">
                        <label class="btn btn-people-amount" for="optionKids1">1</label>

                        <input type="radio" class="btn-check" name="optionsKids" id="optionKids2" autocomplete="off">
                        <label class="btn btn-people-amount" for="optionKids2">2</label>

                        <input type="radio" class="btn-check" name="optionsKids" id="optionKids3" autocomplete="off">
                        <label class="btn btn-people-amount" for="optionKids3">3</label>

                        <input type="radio" class="btn-check" name="optionsKids" id="optionKids4" autocomplete="off">
                        <label class="btn btn-people-amount" for="optionKids4">4</label>

                        <input type="radio" class="btn-check" name="optionsKids" id="optionKids5" autocomplete="off">
                        <label class="btn btn-people-amount" for="optionKids5">5</label>

                        <input type="radio" class="btn-check" name="optionsKids" id="optionKids6" autocomplete="off">
                        <label class="btn btn-people-amount" for="optionKids6">6</label>

                        <input type="radio" class="btn-check" name="optionsKids" id="optionKids7" autocomplete="off">
                        <label class="btn btn-people-amount" for="optionKids7">7</label>

                        <input type="radio" class="btn-check" name="optionsKids" id="optionKids8" autocomplete="off">
                        <label class="btn btn-people-amount" for="optionKids8">8</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label fw-bold">Comments</label>
                    <textarea class="form-control" id="message-text" placeholder="Leave your comment for the restaurant here"></textarea>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="fw-bold">Total to pay for courses at the restaurant:</p>
                    <div class="d-flex gap-1">
                        <p>€</p>
                        <p id="fullPrice">0,00</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="d-flex gap-1">
                        <p class="fw-bold">Total to pay for the reservation:</p>
                        <p>*</p>
                    </div>
                    <div class="d-flex gap-1">
                        <p>€</p>
                        <p id="reservationPrice">0,00</p>
                    </div>
                </div>
                <div>
                    <p>* Reservation is mandatory. A reservation fee of € 10,00 per person is charged when a reservation
                        is made. This fee will be deducted from the final check on visiting the restaurant. The
                        reservation fee is non-refundable.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary d-flex text-nowrap align-items-center gap-2 py-2 px-3">
                    <span>Add to cart</span>
                    <img src="/assets/images/shopping_cart_white.svg" alt="Shopping cart">
                </button>
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
            <p class="col col-md-4 col-lg-3 fw-bold m-0">Dinner price (Adult / Kids)</p>
            <p class="col col-md-3 col-lg-2 fw-bold m-0">Seats available</p>
        </div>
    </div>
    <div class="session row row-cols-4 row-cols-md-5 align-items-center">
        <p class="col col-md-2 col-lg-2 start m-0"></p>
        <p class="col col-md-2 col-lg-2 duration m-0"></p>
        <p class="col col-md-4 col-lg-3 price m-0"></p>
        <p class="col col-md-2 col-lg-2 seats m-0"></p>
        <div class="col-12 col-md-2 col-lg-3 button p-0">
            <button class="btn btn-primary d-flex text-nowrap align-items-center gap-2 py-2 px-3" data-bs-toggle="modal"
                    data-bs-target="#bookingModal">
                <span>Add to cart</span>
                <img src="/assets/images/shopping_cart_white.svg" alt="Shopping cart">
            </button>
        </div>
    </div>
</section>
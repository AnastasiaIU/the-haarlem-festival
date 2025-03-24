<section class="restaurant-card d-flex flex-column flex-lg-row w-100 gap-2">
    <div class="restaurant-card-text d-flex flex-column w-100 gap-2">
        <div class="d-flex flex-column w-100">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 w-100 pb-2">
                <h3 class="restaurant-name h5 fw-bold m-0"></h3>
                <div class="michelin d-flex gap-1 align-items-center">
                    <p class="michelin-text h5 m-0">MICHELIN</p>
                    <img class="michelin-icon" src="/assets/images/michelin-icon.svg" alt="Michelin star">
                </div>
            </div>
        </div>
        <div class="food-types d-flex w-100 flex-wrap gap-2">
            <div class="food-type d-flex align-items-center gap-2 py-1 px-3">
                <img class="food-type-icon" src="" alt="">
                <p class="food-type-text m-0"></p>
            </div>
        </div>
        <div class="restaurant-address d-flex">
            <a target="_blank"></a>
        </div>
        <div class="restaurant-stars d-flex py-2"></div>
        <div class="restaurant-description d-flex mb-2"></div>
        <div class="d-flex flex-wrap">
            <div class="restaurant-card-button">
                <a type="button" class="btn btn-primary font-p-16 fw-bold">Learn more</a>
            </div>
            <div class="d-flex">
                <p class="restaurant-price-full"></p>
                <p class="restaurant-price"></p>
            </div>
        </div>
    </div>
    <div class="restaurant-card-img d-flex col-lg-4">
        <?php include __DIR__ . '/../../carousel_one.php' ?>
    </div>
</section>
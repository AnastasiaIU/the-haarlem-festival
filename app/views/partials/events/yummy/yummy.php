<section id="yummyMainContent" class="col-xxl-8 col-12 d-flex flex-column align-items-center p-3 p-lg-5 gap-5">
    <section id="filtersContainer" class="d-flex flex-column w-100 m-0 p-0">
        <form method="post" class="tinymce-form">
            <p class="tinymce" id="filter-prompt" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
            <input type="hidden" name="content" class="tinymce-input" data-field_id="filter-prompt">
            <button type="submit" class="tinymce-save">Save</button>
        </form>
        <div id="foodTypes" class="d-flex flex-wrap gap-2">
            <div class="food-filter-disabled d-flex align-items-center gap-2 py-1 px-3">
                <img class="filter-icon" src="" alt="">
                <p class="filter-text m-0"></p>
            </div>
        </div>
    </section>
    <section id="restaurantCards" class="col-xxl-8 d-flex flex-column m-0 p-0">
        <?php include __DIR__ . '/restaurant_card.php' ?>
    </section>
    <section class="event-map col-xxl-8 d-flex flex-column m-0">
        <div class="d-flex gap-2 pb-2">
            <img class="location-icon" src="/assets/images/location-icon.svg" alt="Location icon">
            <h2 class="locations-header h4 fw-bold">Locations</h2>
        </div>
        <iframe
                style="border:0"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
                width="100%"
                height="100%"
                src="https://www.google.com/maps/d/u/0/embed?mid=1b70oMK4a7zlSopB7cQImDyAR10qbzTk&ehbc=D43D25&noprof=1">
        </iframe>
    </section>
</section>
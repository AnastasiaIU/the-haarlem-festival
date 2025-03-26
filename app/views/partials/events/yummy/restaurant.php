<section id="restaurantMainContent" class="col-xxl-8 col-12 d-flex flex-column align-items-center p-3 p-lg-5 gap-5">
    <div class="hero-shape-fix" id="heroShapeFix"></div>
    <section class="d-flex flex-column">
        <h2 class="book-header h4 fw-bold"></h2>
        <p class="book-description d-flex flex-wrap gap-5 m-0 p-0"></p>
    </section>
    <section id="restaurantSchedule" class="d-flex flex-column w-100 m-0 gap-5">
        <?php include __DIR__ . '/restaurant_schedule.php' ?>
    </section>
    <section id="restaurantCarousel" class="d-flex flex-column w-100 gap-5 m-0 p-0">
        <?php include __DIR__ . '/../../carousel_one.php' ?>
        <?php include __DIR__ . '/../../carousel_three.php' ?>
    </section>
</section>
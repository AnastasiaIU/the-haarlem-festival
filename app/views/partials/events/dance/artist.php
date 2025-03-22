<section id="artistMainContent" class="d-flex flex-column align-items-center p-3 p-lg-5 gap-5">
    <div class="hero-shape-fix" id="heroShapeFix"></div>
    <section id="artistTracks" class="col-lg-10 col-xl-8 d-flex flex-column gap-5 m-0 p-0">
        <?php include __DIR__ . '/track.php' ?>
    </section>
    <section id="artistCarousel" class="d-flex flex-column w-100 gap-5 m-0 p-0">
        <?php include __DIR__ . '/../../carousel_one.php' ?>
        <?php include __DIR__ . '/../../carousel_three.php' ?>
    </section>
    <section id="artistSchedule" class="col-xxl-8 d-flex flex-column m-0 p-5">
        <?php include __DIR__ . '/artist_schedule.php' ?>
    </section>
</section>
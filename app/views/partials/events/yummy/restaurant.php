<section id="restaurantMainContent" class="col-xxl-8 col-12 d-flex flex-column align-items-center p-3 p-lg-5 gap-5">
    <div class="hero-shape-fix" id="heroShapeFix"></div>
    <section class="d-flex flex-column">
        <form method="post" class="tinymce-form">
            <h2 class="tinymce book-header h4 fw-bold"
                id="bookHeader" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></h2>
            <input type="hidden" name="content" class="tinymce-input" data-field_id="bookHeader">
            <button type="submit" class="tinymce-save">Save</button>
        </form>
        <form method="post" class="tinymce-form">
            <p class="tinymce book-description d-flex flex-wrap gap-5 m-0 p-0"
               id="bookDescription" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
            <input type="hidden" name="content" class="tinymce-input" data-field_id="bookDescription">
            <button type="submit" class="tinymce-save">Save</button>
        </form>
    </section>
    <section id="restaurantSchedule" class="d-flex flex-column w-100 m-0 gap-5">
        <?php include __DIR__ . '/restaurant_schedule.php' ?>
    </section>
    <section id="restaurantCarousel" class="d-flex flex-column w-100 gap-5 m-0 p-0">
        <?php include __DIR__ . '/../../carousel_one.php' ?>
        <?php include __DIR__ . '/../../carousel_three.php' ?>
    </section>
</section>
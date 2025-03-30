<section id="locationMainContent" class="d-flex flex-column align-items-center p-3 p-lg-5 gap-5">
    <div class="hero-shape-fix" id="heroShapeFix"></div>
    <section class="col-md-8 d-flex flex-column gap-4">
        <div class="d-flex flex-column">
            <form method="post" class="tinymce-form">
                <h2 class="tinymce location-header h4 fw-bold" id="location-header-1" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></h2>
                <input type="hidden" name="content" class="tinymce-input" data-field_id="location-header-1">
                <button type="submit" class="tinymce-save">Save</button>
            </form>
            <form method="post" class="tinymce-form">
                <p class="tinymce m-0" id="location-text-1" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
                <input type="hidden" name="content" class="tinymce-input" data-field_id="location-text-1">
                <button type="submit" class="tinymce-save">Save</button>
            </form>
        </div>
        <div class="d-flex flex-column">
            <form method="post" class="tinymce-form">
                <h2 class="tinymce location-header h4 fw-bold" id="location-header-2" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></h2>
                <input type="hidden" name="content" class="tinymce-input" data-field_id="location-header-2">
                <button type="submit" class="tinymce-save">Save</button>
            </form>
            <form method="post" class="tinymce-form">
                <p class="tinymce m-0" id="location-text-2" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
                <input type="hidden" name="content" class="tinymce-input" data-field_id="location-text-2">
                <button type="submit" class="tinymce-save">Save</button>
            </form>
        </div>
        <div class="d-flex flex-column">
            <form method="post" class="tinymce-form">
                <h2 class="tinymce location-header h4 fw-bold" id="location-header-3" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></h2>
                <input type="hidden" name="content" class="tinymce-input" data-field_id="location-header-3">
                <button type="submit" class="tinymce-save">Save</button>
            </form>
            <form method="post" class="tinymce-form">
                <p class="tinymce m-0" id="location-text-3" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
                <input type="hidden" name="content" class="tinymce-input" data-field_id="location-text-3">
                <button type="submit" class="tinymce-save">Save</button>
            </form>
        </div>
    </section>
    <section id="locationCarousel" class="d-flex flex-column w-100 gap-5 m-0 p-0">
        <?php include __DIR__ . '/../../carousel_one.php' ?>
        <?php include __DIR__ . '/../../carousel_three.php' ?>
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
                src="https://www.google.com/maps/d/u/0/embed?mid=1rfOaj-DZrHl78uIRsxmwf0KNH0-vIwQ&ehbc=D43D25&noprof=1">
        </iframe>
    </section>
</section>
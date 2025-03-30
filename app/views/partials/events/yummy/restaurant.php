<section id="restaurantMainContent" class="d-flex flex-column align-items-center p-3 p-lg-5 gap-5 w-100">
    <div class="hero-shape-fix" id="heroShapeFix"></div>
    <div class="col-xxl-8 col-12 d-flex flex-column align-items-center gap-5">
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
        <section id="restaurantMenu" class="d-flex flex-column w-100 justify-content-center">
            <h2 class="menu-header h4 fw-bold mb-3">Menu</h2>
            <div class="d-flex col-8 w-100 image-container">
                <img id="menuImg" class="w-100" src="" alt="">
                <button class="change-image" id="menuImgButton">Change Image</button>
                <input class="d-none" type="file" accept="image/*" data-button="menuImgButton">
            </div>
        </section>
        <section id="restaurantChef" class="flex-column w-100 justify-content-center">
            <h2 class="chef-header h4 fw-bold mb-3" id="chefName"></h2>
            <div class="d-flex flex-column flex-lg-row w-100 gap-4">
                <div class="chef-image-container col-12 col-lg-4">
                    <img id="chefImage" class="chef-image" src="" alt="">
                    <button class="change-image" id="chefImageButton">Change Image</button>
                    <input class="d-none" type="file" accept="image/*" data-button="chefImageButton">
                </div>
                <div class="d-flex align-items-center">
                    <form method="post" class="tinymce-form">
                        <p class="tinymce m-0"
                           id="chefDescription" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
                        <input type="hidden" name="content" class="tinymce-input" data-field_id="chefDescription">
                        <button type="submit" class="tinymce-save">Save</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
    <section id="restaurantCarousel" class="d-flex flex-column w-100 m-0 p-0">
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
                src="https://www.google.com/maps/d/u/0/embed?mid=1b70oMK4a7zlSopB7cQImDyAR10qbzTk&ehbc=D43D25&noprof=1">
        </iframe>
    </section>
    <section id="restaurantContacts" class="d-flex flex-column w-100 m-0 p-0 justify-content-center align-items-center">
        <?php include __DIR__ . '/contacts.php' ?>
    </section>
</section>
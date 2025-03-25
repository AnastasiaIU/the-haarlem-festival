<section class="hero-section container-fluid" id="heroSection">
    <div class="container-fluid d-flex p-0" id="heroContainer">
        <div class="col-md-6 hero-image p-0">
            <div class="hero-shape" id="heroShape"></div>
            <img src="" alt="Hero Image" id="heroImage">
            <button class="change-image" id="heroImageButton">Change Image</button>
            <input class="d-none" type="file" accept="image/*" data-button="heroImageButton">
        </div>
        <div class="container-fluid d-flex justify-content-center p-0">
            <div class="col-xxl-10 hero-content px-4 py-5 gap-1">
                <div class="restaurant-hero d-flex flex-column w-100 gap-2">
                    <div class="d-flex flex-column w-100">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 w-100 pb-2">
                            <form method="post" class="tinymce-form">
                                <h3 class="tinymce restaurant-name h4 text-white fw-bold m-0"
                                    id="heroRestaurantName" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></h3>
                                <input type="hidden" name="content" class="tinymce-input"
                                       data-field_id="heroRestaurantName">
                                <button type="submit" class="tinymce-save">Save</button>
                            </form>
                            <div class="michelin d-flex gap-1 align-items-center">
                                <p class="text-white h5 m-0">MICHELIN</p>
                                <img class="michelin-icon" src="/assets/images/michelin-icon-white.svg"
                                     alt="Michelin star">
                            </div>
                        </div>
                    </div>
                    <div class="food-types d-flex w-100 flex-wrap gap-2">
                        <div class="food-type d-flex align-items-center gap-2 py-1 px-3">
                            <img class="food-type-icon" src="" alt="">
                            <p class="food-type-text m-0"></p>
                        </div>
                    </div>
                    <div class="hero-restaurant-address d-flex">
                        <a target="_blank"></a>
                    </div>
                    <div class="restaurant-stars d-flex py-2"></div>
                    <form method="post" class="tinymce-form">
                        <p class="tinymce d-flex mb-2 text-white"
                           id="heroRestaurantDescription" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
                        <input type="hidden" name="content" class="tinymce-input"
                               data-field_id="heroRestaurantDescription">
                        <button type="submit" class="tinymce-save">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
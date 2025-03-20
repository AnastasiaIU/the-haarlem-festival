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
                <form method="post" class="tinymce-form">
                    <h1 class="tinymce h3 text-white fw-bold" id="hero-title" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></h1>
                    <input type="hidden" name="content" class="tinymce-input" data-field_id="hero-title">
                    <button type="submit" class="tinymce-save">Save</button>
                </form>
                <form method="post" class="tinymce-form">
                    <h2 class="tinymce h4 text-white fw-bold" id="hero-subtitle" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></h2>
                    <input type="hidden" name="content" class="tinymce-input" data-field_id="hero-subtitle">
                    <button type="submit" class="tinymce-save">Save</button>
                </form>
                <form method="post" class="tinymce-form">
                    <p class="tinymce text-white" id="hero-text" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
                    <input type="hidden" name="content" class="tinymce-input" data-field_id="hero-text">
                    <button type="submit" class="tinymce-save">Save</button>
                </form>
                <?php include __DIR__ . '/teylers/app_promotion_hero.php'; ?>
            </div>
        </div>
    </div>
</section>
<section class="location-card d-flex flex-column flex-md-row pb-3 align-items-center gap-4">
    <div class="text-container d-flex flex-column justify-content-between">
        <div class="d-flex flex-column">
            <form method="post" class="tinymce-form-locations">
                <h3 class="tinymce-locations location-name h4 fw-bold mb-2" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></h3>
                <input type="hidden" name="content" class="tinymce-input">
                <button type="submit" class="tinymce-save">Save</button>
            </form>
            <form method="post" class="tinymce-form-locations">
                <p class="tinymce-locations location-text mb-1" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
                <input type="hidden" name="content" class="tinymce-input">
                <button type="submit" class="tinymce-save">Save</button>
            </form>
            <div class="location-address d-flex mb-4">
                <a target="_blank"></a>
            </div>
            <div class="location-card-button">
                <a type="button" class="btn btn-primary font-p-16 fw-bold">Learn more</a>
            </div>
        </div>
    </div>
    <div class="col-md-4 location-image-container">
        <img class="location-card-image" src="" alt="">
        <button class="change-image-location">Change Image</button>
        <input class="d-none" type="file" accept="image/*">
    </div>
</section>
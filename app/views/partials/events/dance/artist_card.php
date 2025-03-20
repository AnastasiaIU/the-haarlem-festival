<section class="artist-card d-flex pb-3">
    <div class="artist-card-text-container d-flex flex-column justify-content-between pe-3">
        <div class="d-flex flex-column">
            <form method="post" class="tinymce-form-artist-card">
                <h3 class="tinymce-artist-card card-stage-name" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></h3>
                <input type="hidden" name="content" class="tinymce-input" data-field_id="stage_name">
                <button type="submit" class="tinymce-save">Save</button>
            </form>
            <form method="post" class="tinymce-form-artist-card">
                <p class="tinymce-artist-card h5 card-genre" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
                <input type="hidden" name="content" class="tinymce-input" data-field_id="genre">
                <button type="submit" class="tinymce-save">Save</button>
            </form>
            <form method="post" class="tinymce-form-artist-card">
                <p class="tinymce-artist-card card-description" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
                <input type="hidden" name="content" class="tinymce-input" data-field_id="card_description">
                <button type="submit" class="tinymce-save">Save</button>
            </form>
        </div>
        <div class="artist-card-button"></div>
    </div>
    <div class="col-md-3 artist-card-image-container">
        <img class="artist-card-image" src="" alt="">
        <button class="change-image-artist-card">Change Image</button>
        <input class="d-none" type="file" accept="image/*">
    </div>
</section>
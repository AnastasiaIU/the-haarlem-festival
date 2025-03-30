<section class="container-fluid d-flex flex-column flex-grow-1 p-0 justify-content-center align-items-center">
    <div class="d-flex flex-column p-3 p-md-5 gap-4 justify-content-center align-items-center">
        <div class="col-xl-8 d-inline-flex flex-column">
            <form method="post" class="tinymce-form">
                <h2 class="tinymce mb-3" id="strollsTitle" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></h2>
                <input type="hidden" name="content" class="tinymce-input" data-field_id="strollsTitle">
                <button type="submit" class="tinymce-save">Save</button>
            </form>
            <form method="post" class="tinymce-form">
                <p class="tinymce" id="strollsDescription" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
                <input type="hidden" name="content" class="tinymce-input" data-field_id="strollsDescription">
                <button type="submit" class="tinymce-save">Save</button>
            </form>
        </div>
        <div class="col-xl-8 d-flex flex-column gap-2">
            <form method="post" class="tinymce-form">
                <h2 class="tinymce" id="strollsLocationsTitle" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>>Locations</h2>
                <input type="hidden" name="content" class="tinymce-input" data-field_id="strollsLocationsTitle">
                <button type="submit" class="tinymce-save">Save</button>
            </form>
            <div id="locationsContainer" class="d-flex flex-column gap-4 w-100">
                <?php include __DIR__ . '/location_card.php' ?>
            </div>
        </div>
    </div>
</section>
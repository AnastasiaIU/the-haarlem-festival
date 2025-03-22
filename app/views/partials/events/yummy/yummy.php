<main id="yummyMainContent" class="d-flex flex-column align-items-center p-3 p-lg-5 gap-5">
    <section id="filtersContainer" class="d-flex flex-column w-100 m-0 p-0">
        <form method="post" class="tinymce-form">
            <p class="tinymce" id="filter-prompt" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
            <input type="hidden" name="content" class="tinymce-input" data-field_id="filter-prompt">
            <button type="submit" class="tinymce-save">Save</button>
        </form>
        <div id="foodTypes" class="d-flex gap-2">
            <div class="food-filter-disabled d-flex gap-2 py-1 px-3">
                <img class="filter-icon" src="" alt="">
                <p class="filter-text m-0"></p>
            </div>
        </div>
    </section>
</main>
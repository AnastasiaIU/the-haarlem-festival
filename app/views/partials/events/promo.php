<section class="promo-section container-fluid" id="promoSection">
    <div class="promo-shape" id="promoShape"></div>
    <div class="container-fluid d-flex p-0" id="promoContainer">
        <div class="container-fluid d-flex justify-content-center p-0">
            <div class="promo-content py-3 gap-2">
                <form method="post" class="tinymce-form">
                    <h2 class="tinymce h3 m-0 fw-bold"
                        id="promo-title" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></h2>
                    <input type="hidden" name="content" class="tinymce-input" data-field_id="promo-title">
                    <button type="submit" class="tinymce-save">Save</button>
                </form>
                <form method="post" class="tinymce-form">
                    <p class="tinymce h4 m-0 fw-bold"
                       id="promo-subtitle" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
                    <input type="hidden" name="content" class="tinymce-input" data-field_id="promo-subtitle">
                    <button type="submit" class="tinymce-save">Save</button>
                </form>
            </div>
        </div>
    </div>
</section>

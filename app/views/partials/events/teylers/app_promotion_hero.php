<div id="appPromotionHero">
    <form method="post" class="tinymce-form">
        <p id="appPromotionTitle" class="tinymce h3 text-white fw-bold" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
        <input type="hidden" name="content" class="tinymce-input" data-field_id="appPromotionTitle">
        <button type="submit" class="tinymce-save">Save</button>
    </form>
    <div id="appBadges" class="d-flex flex-wrap gap-2 justify-content-end align-items-center">
        <form method="post" class="tinymce-form">
            <p id="appPromotionSubtitle" class="tinymce text-white fw-bold m-0" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>></p>
            <input type="hidden" name="content" class="tinymce-input" data-field_id="appPromotionSubtitle">
            <button type="submit" class="tinymce-save">Save</button>
        </form>
        <a href="https://play.google.com/store" target="_blank">
            <img class="app-badge" src="/assets/images/GetItOnGooglePlay_Badge_Web_color_English.png"
                 alt="Get it on Google Play"/>
        </a>
        <a href="https://www.apple.com/app-store/" target="_blank">
            <img class="app-badge"
                 src="https://developer.apple.com/assets/elements/badges/download-on-the-app-store.svg"
                 alt="Download on the App Store"/>
        </a>
    </div>
</div>
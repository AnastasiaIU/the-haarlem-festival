<section class="hero-section container-fluid" id="heroSection">
    <div class="container-fluid d-flex p-0" id="heroContainer">
        <div class="col-md-6 hero-image p-0">
            <div class="hero-shape" id="heroShape"></div>
            <img src="" alt="Hero Image" id="heroImage">
            <button class="change-image" id="heroImageButton">Change Image</button>
            <input class="d-none" type="file" accept="image/*" data-button="heroImageButton">
        </div>
        <div class="container-fluid d-flex justify-content-center p-0">
            <div class="col-xxl-10 hero-content p-4 gap-1">
                <h1 class="h3 text-white fw-bold" id="hero-title"></h1>
                <h2 class="h4 text-white fw-bold" id="hero-subtitle"></h2>
                <p class="text-white" id="hero-text"></p>
                <?php include __DIR__ . '/teylers/app_promotion_hero.php'; ?>
            </div>
        </div>
    </div>
</section>
<form action="save_content.php" method="post">
    <h1 class="tinymce" name="content" <?php if ($isAdmin) echo 'contenteditable="true"'; ?>>HERO</h1>
    <input type="hidden" name="content" id="hiddenContent">
    <button type="submit" class="tinymce-save">Save</button>
</form>
<script>
    document.querySelector("form").addEventListener("submit", function () {
        document.getElementById("hiddenContent").value = document.querySelector(".tinymce").innerHTML;
    });
</script>
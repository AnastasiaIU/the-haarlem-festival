<section class="hero-section container-fluid" id="heroSection">
    <div class="row">
        <div class="col-md-6 hero-image">
            <img src="" alt="Hero Image" id="heroImage">
            <button class="change-image" id="heroImageButton">Change Image</button>
            <input class="d-none" type="file" accept="image/*" data-button="heroImageButton">
        </div>
        <div class="col-md-6 hero-content">
            <div class="hero-shape" id="heroShape"></div>
            <h1 class="hero-title">Your Hero Title</h1>
            <p class="hero-text">This is your hero section description. Add any text here.</p>
            <a href="#" class="btn btn-primary">Learn More</a>
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
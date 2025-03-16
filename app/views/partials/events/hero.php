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
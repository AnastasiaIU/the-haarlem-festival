<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Haarlem Festival</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../../assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/shopping-cart.css">
    <link rel="icon" type="image/x-icon" href="../../assets/images/favicon.svg">
    <link href='https://fonts.googleapis.com/css?family=Open Sans' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Cabin' rel='stylesheet'>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
            integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
            crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdn.tiny.cloud/1/clwrf6ykpssoswy8p2on10mut3yv9h65futcwnlgkg48h573/tinymce/7/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script type="module" src="../../assets/js/main.js"></script>
    <?php
    $isAdmin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Administrator';
    ?>
    <?php if ($isAdmin): ?>
        <script>
            tinymce.init({
                selector: '.tinymce', // Target elements with class 'tinymce'
                inline: true, // Enable inline editing for non-textarea elements
                toolbar: 'bold italic underline | alignleft aligncenter alignright | undo redo',
                menubar: false, // Remove the menubar for a cleaner UI
                plugins: 'autoresize', // Enable autoresize for better UX
                forced_root_block: false, // Prevents TinyMCE from wrapping content in <p>
            });
        </script>
        <style>
            .tinymce-save {
                display: inline-block !important;
            }
        </style>
    <?php endif; ?>
</head>

<body class="d-flex flex-column min-vh-100">
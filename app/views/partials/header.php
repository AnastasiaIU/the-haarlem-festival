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
    <link rel="stylesheet" type="text/css" href="../../assets/css/hero.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/promo.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/artist.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/homepage.css">
    <link rel="stylesheet" type="text/css" href="../../assets/css/food-type.css">
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
    <script type="module" src="../../assets/js/homepage.js"></script>
    <?php
    $isAdmin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'Administrator';
    ?>
    <?php if ($isAdmin): ?>
        <script>
            tinymce.init({
                selector: '.tinymce', // Target elements with class 'tinymce'
                plugins: [
                    'anchor', 'autolink', 'charmap', 'emoticons', 'link', 'lists', 'searchreplace', 'table', 'visualblocks', 'wordcount'
                ],
                toolbar: 'undo redo | fontfamily fontsize | bold italic underline strikethrough | link table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                inline: true
            });
        </script>
        <style>
            .tinymce-save, [class*="change-image"] {
                display: inline-block !important;
            }
        </style>
    <?php endif; ?>
</head>

<body class="d-flex flex-column min-vh-100">
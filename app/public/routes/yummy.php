<?php

Route::add('/yummy', function () {
    $pageTitle = "Yummy!";

    ob_start();
    require_once(__DIR__ . '/../views/pages/events/yummy/index.php');
    $content = ob_get_clean();

    require_once(__DIR__ . '/../views/layouts/event-layout.php');
}, 'GET');

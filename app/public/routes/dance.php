<?php

Route::add('/dance', function () {
    // Set a page title just in case
    $pageTitle = "DANCE!";

    // Capture the unique content for the Dance event
    ob_start();
    require_once(__DIR__ . '/../views/pages/events/dance/index.php');
    $content = ob_get_clean();

    // Wrap it in the event layout
    require_once(__DIR__ . '/../views/layouts/event-layout.php');
}, 'GET');

<?php

Route::add('/strolls', function () {
    $pageTitle = "History Strolls";

    ob_start();
    require_once(__DIR__ . '/../views/pages/events/history-stroll/index.php');
    $content = ob_get_clean();

    require_once(__DIR__ . '/../views/layouts/event-layout.php');
}, 'GET');

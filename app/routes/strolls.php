<?php

Route::add('/strolls', function () {
    // Store the current URL in the session
    $_SESSION['last_visited_url'] = $_SERVER['REQUEST_URI'];

    require_once(__DIR__ . "/../views/pages/events/strolls.php");
});

Route::add('/strolls/schedule', function () {
    // Store the current URL in the session
    $_SESSION['last_visited_url'] = $_SERVER['REQUEST_URI'];

    require_once(__DIR__ . "/../views/pages/events/strolls-schedule.php");
});

Route::add('/strolls/([a-z-0-9-]*)', function () {
    // Store the current URL in the session
    $_SESSION['last_visited_url'] = $_SERVER['REQUEST_URI'];

    require_once(__DIR__ . "/../views/pages/events/strolls-location.php");
});
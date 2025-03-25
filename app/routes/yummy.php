<?php

Route::add('/yummy', function () {
    // Store the current URL in the session
    $_SESSION['last_visited_url'] = $_SERVER['REQUEST_URI'];

    require_once(__DIR__ . "/../views/pages/events/yummy.php");
});

Route::add('/yummy/([a-z-0-9-]*)', function () {
    // Store the current URL in the session
    $_SESSION['last_visited_url'] = $_SERVER['REQUEST_URI'];

    require_once(__DIR__ . "/../views/pages/events/yummy-restaurant.php");
});

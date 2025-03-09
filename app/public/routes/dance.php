<?php

Route::add('/dance', function () {
    // Store the current URL in the session
    $_SESSION['last_visited_url'] = $_SERVER['REQUEST_URI'];

    $artist = "Hardwell";
    require_once(__DIR__ . "/../views/pages/events/dance.php");
});

Route::add('/dance/artist/([a-z-0-9-]*)', function ($artist) {
    // Store the current URL in the session
    $_SESSION['last_visited_url'] = $_SERVER['REQUEST_URI'];

    require_once(__DIR__ . "/../views/pages/events/dance-artist.php");
});
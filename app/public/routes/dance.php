<?php

Route::add('/dance', function () {
    $artist = "Hardwell";
    require_once(__DIR__ . "/../views/pages/events/dance.php");
});

Route::add('/dance/artist/([a-z-0-9-]*)', function ($artist) {
    require_once(__DIR__ . "/../views/pages/events/dance-artist.php");
});
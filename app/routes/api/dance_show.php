<?php

require_once(__DIR__ . '/../../src/controllers/DanceShowController.php');

Route::add('/api/getDanceShowsByArtist/([a-zA-Z0-9_-]*)', function ($artistSlug) {
    $showController = new DanceShowController();
    $show = $showController->fetchAllShows($artistSlug);
    echo json_encode($show);
});
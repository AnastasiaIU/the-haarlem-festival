<?php

require_once(__DIR__ . '/../../src/controllers/DanceShowController.php');

Route::add('/api/getDanceShowsByArtist/([0-9]+)', function ($artistId) {
    $showController = new DanceShowController();
    $show = $showController->fetchAllShows($artistId);
    echo json_encode($show);
});
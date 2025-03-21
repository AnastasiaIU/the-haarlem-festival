<?php

require_once(__DIR__ . '/../../src/controllers/ArtistController.php');

Route::add('/api/getArtists', function () {
    $artistController = new ArtistController();
    $artists = $artistController->fetchAllArtists();
    echo json_encode($artists);
});

Route::add('/api/getArtistById/([0-9]+)', function ($artistId) {
    $artistController = new ArtistController();
    $artist = $artistController->fetchArtistById($artistId);
    echo json_encode($artist);
});

Route::add('/api/getArtistBySlug/([a-zA-Z0-9_-]*)', function ($artistSlug) {
    $artistController = new ArtistController();
    $artist = $artistController->fetchArtistBySlug($artistSlug);
    echo json_encode($artist);
});
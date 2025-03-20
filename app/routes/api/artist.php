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
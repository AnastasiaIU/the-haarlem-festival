<?php

require_once(__DIR__ . '/../../src/controllers/VenueController.php');

Route::add('/api/getVenueById/([0-9]+)', function ($venueId) {
    $venueController = new VenueController();
    $venue = $venueController->fetchVenueById($venueId);
    echo json_encode($venue);
});
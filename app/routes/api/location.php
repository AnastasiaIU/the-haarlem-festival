<?php

require_once(__DIR__ . '/../../src/controllers/LocationController.php');

Route::add('/api/getLocations', function () {
    $locationController = new LocationController();
    $location = $locationController->fetchAllLocations();
    echo json_encode($location);
});

Route::add('/api/getLocationBySlug/([a-zA-Z0-9_-]*)', function ($locationSlug) {
    $locationController = new LocationController();
    $location = $locationController->fetchLocationBySlug($locationSlug);
    echo json_encode($location);
});
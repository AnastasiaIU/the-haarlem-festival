<?php

require_once(__DIR__ . '/../../src/controllers/TourController.php');

/**
 * API route to fetch all tours.
 */
Route::add('/api/getTours', function () {
    $tourController = new TourController();
    $tours = $tourController->fetchAllTours();
    echo json_encode($tours);
});
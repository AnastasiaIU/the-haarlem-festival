<?php

require_once(__DIR__ . '/../../src/controllers/PassController.php');

Route::add('/api/getPasses', function () {
    $passController = new PassController();
    $passes = $passController->fetchAllPasses();
    echo json_encode($passes);
});

Route::add('/api/getPassesAvailability', function () {
    $passController = new PassController();
    $availability = $passController->passesAvailable();
    echo json_encode($availability);
});
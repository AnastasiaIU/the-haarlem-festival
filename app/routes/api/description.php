<?php

require_once(__DIR__ . '/../../src/controllers/DescriptionController.php');

Route::add('/api/getDescriptionsByLocationId/([0-9]+)', function ($descriptionId) {
    $descriptionController = new DescriptionController();
    $description = $descriptionController->fetchDescriptionsByLocation($descriptionId);
    echo json_encode($description);
});
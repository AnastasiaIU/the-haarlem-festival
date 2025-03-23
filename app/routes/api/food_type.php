<?php

require_once(__DIR__ . '/../../src/controllers/FoodTypeController.php');

Route::add('/api/getFoodTypes', function () {
    $foodTypeController = new FoodTypeModel();
    $foodTypes = $foodTypeController->fetchAllFoodTypes();
    echo json_encode($foodTypes);
});
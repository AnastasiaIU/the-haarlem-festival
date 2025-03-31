<?php

require_once(__DIR__ . '/../../src/controllers/ChefController.php');

Route::add('/api/getChefByRestaurantId/([0-9]+)', function ($restaurantId) {
    $chefController = new ChefController();
    $chef = $chefController->fetchChefByRestaurant($restaurantId);
    echo json_encode($chef);
});
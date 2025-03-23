<?php

require_once(__DIR__ . '/../../src/controllers/RestaurantController.php');

Route::add('/api/getRestaurants', function () {
    $restaurantController = new RestaurantController();
    $restaurant = $restaurantController->fetchAllRestaurants();
    echo json_encode($restaurant);
});

Route::add('/api/getRestaurantBySlug/([a-zA-Z0-9_-]*)', function ($restaurantSlug) {
    $restaurantController = new RestaurantController();
    $restaurant = $restaurantController->fetchRestaurantBySlug($restaurantSlug);
    echo json_encode($restaurant);
});
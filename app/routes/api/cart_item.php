<?php

require_once(__DIR__ . '/../../src/controllers/CartItemController.php');

$carItemController = new CartItemController();

Route::add('/api/cart-item/pass/([0-9]+)', function ($id) use ($carItemController) {
    header('Content-Type: application/json');

    $cartItem = $carItemController->fetchPassCartItem($id);
    echo json_encode($cartItem->toArray());
});

Route::add('/api/cart-item/dance-show/([0-9]+)/([a-zA-Z0-9-]+)', function ($id, $slug) use ($carItemController) {
    header('Content-Type: application/json');

    $cartItem = $carItemController->fetchDanceShowItem($id, $slug);
    echo json_encode($cartItem->toArray());
});
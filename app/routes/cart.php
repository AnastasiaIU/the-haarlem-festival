<?php

require_once(__DIR__ . '/../src/services/AuthHandler.php');

$authHandler = new AuthHandler();

Route::add('/cart', function () use ($authHandler) {
    $authHandler->checkUserLoggedIn();
    require_once(__DIR__ . "/../views/pages/cart.php");
});

Route::add('/cart/checkout', function () use ($authHandler) {
    $authHandler->checkUserLoggedIn();
    require_once(__DIR__ . "/../views/pages/checkout.php");
});

Route::add('/cart/checkout/confirmation', function () use ($authHandler) {
    $authHandler->checkUserLoggedIn();
    require_once(__DIR__ . "/../views/pages/completed-payment.php");
});
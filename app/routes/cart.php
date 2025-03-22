<?php

Route::add('/cart', function () {
    // Store the current URL in the session
    $_SESSION['last_visited_url'] = $_SERVER['REQUEST_URI'];

    require_once(__DIR__ . "/../views/pages/cart.php");
});

Route::add('/cart/checkout', function () {
    require_once(__DIR__ . "/../views/pages/checkout.php");
});

Route::add('/cart/checkout/confirmation', function () {
    require_once(__DIR__ . "/../views/pages/completed-payment.php");
});
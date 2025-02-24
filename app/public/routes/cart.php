<?php

Route::add('/cart', function () {
    require_once(__DIR__ . "/../views/pages/cart.php");
});

Route::add('/cart/checkout', function () {
    require_once(__DIR__ . "/../views/pages/checkout.php");
});
<?php

require_once(__DIR__ . "/../../src/services/StripeService.php");

Route::add('/api/stripe/create-payment-intent', function () {
    header('Content-Type: application/json');

    $input = json_decode(file_get_contents('php://input'), true);
    $amount = $input['amount'];
    $currency = $input['currency'];
    $payment_method_type = $input['payment_method_type'];
    $tickets = $input['tickets'];

    $stripeService = new StripeService();
    $response = $stripeService->createPayment($amount, $currency, $payment_method_type, $tickets);

    echo json_encode($response);
}, 'post');

Route::add('/api/stripe/public-key', function () {
    echo json_encode(['public_key' => $_ENV['STRIPE_PUBLIC_KEY']]);
});
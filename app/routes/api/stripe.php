<?php

require_once(__DIR__ . '/../../vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_51QwoutQK69u3tWgIlyxkZsAp8xygOLnRd1QKRhEdEMrAAqTwnryZixsMbICDeuC4gmR27t4nYCJxSPefLHR9COLs00zKZs6HV6');

$paymentMethod = $_POST['payment_method'];
$email = $_POST['email'];

try {
    if ($paymentMethod === 'card') {
        $token = $_POST['stripeToken'];
        $charge = \Stripe\Charge::create([
            'amount' => 5000, // Amount in cents
            'currency' => 'usd',
            'description' => 'Example charge',
            'source' => $token,
            'receipt_email' => $email,
        ]);
        echo 'Payment successful!';
    } elseif ($paymentMethod === 'ideal') {
        $source = $_POST['stripeSource'];
        $charge = \Stripe\Charge::create([
            'amount' => 5000, // Amount in cents
            'currency' => 'eur',
            'source' => $source,
            'receipt_email' => $email,
        ]);
        echo 'Payment successful!';
    }
    // Add handling for PayPal, Apple Pay, and Google Pay here
} catch (\Stripe\Exception\CardException $e) {
    echo 'Error: ' . $e->getMessage();
}
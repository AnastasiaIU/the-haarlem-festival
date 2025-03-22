<?php

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\Exception\ApiErrorException;

require(__DIR__ . "/../../vendor/autoload.php");

class StripeService {
    public function __construct() {
        Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);
    }

    public function createPayment(int $amount, string $currency, string $payment_method_type, array $tickets) {
        try {
            $metadata = [];
            foreach ($tickets as $index => $ticket) {
                $metadata["product_{$index}_name"] = $ticket['name'];
                $metadata["product_{$index}_quantity"] = $ticket['quantity'];
                $metadata["product_{$index}_price"] = $ticket['price'];
            }

            $paymentIntent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => $currency,
                'payment_method_types' => [$payment_method_type],
                'metadata' => $metadata
            ]);

            return ['clientSecret' => $paymentIntent->client_secret];
        } catch (ApiErrorException $e) {
            http_response_code(500);
            return ['error' => $e->getMessage()];
        } catch (Exception $e) {
            http_response_code(500);
            return ['error' => $e->getMessage()];
        }
    }
}
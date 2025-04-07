<?php

use Stripe\Stripe;
use Stripe\PaymentIntent;
use Stripe\PaymentMethod;
use Stripe\Exception\ApiErrorException;

require(__DIR__ . "/../../vendor/autoload.php");

class StripeService {
    public function __construct() {
        Stripe::setApiKey($_ENV['STRIPE_SECRET_KEY']);
    }

    public function createPayment(int $amount, array $tickets) {
        try {
            $metadata = [];
            foreach ($tickets as $index => $ticket) {
                $metadata["product_{$index}_name"] = $ticket['name'];
                $metadata["product_{$index}_quantity"] = $ticket['quantity'];
                $metadata["product_{$index}_price"] = $ticket['price'];
            }

            $paymentMethod = PaymentMethod::create([
                'type' => 'ideal', 
            ]);

            $paymentIntent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'eur',
                'payment_method' => $paymentMethod->id,
                'payment_method_types' => [$paymentMethod->type],
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
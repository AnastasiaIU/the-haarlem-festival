<?php

require_once(__DIR__ . "/../../src/services/NumberGeneratorHandler.php");

Route::add('/api/order-confirmation/code', function () {
    header('Content-Type: application/json');

    $numberGeneratorHandler = new NumberGeneratorHandler();
    $response = $numberGeneratorHandler->generateNumber();

    echo json_encode(['code' => $response]);
});
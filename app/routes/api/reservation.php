<?php

require_once(__DIR__ . '/../../src/controllers/ReservationController.php');

Route::add('/api/reservation', function () {
    header('Content-Type: application/json');

    $input = json_decode(file_get_contents('php://input'), true);

    $reservationController = new ReservationController();
    $response = $reservationController->createReservations($input['reservations']);
    if ($response) {
        echo json_encode($response);
    } else {
        http_response_code(500);
        echo json_encode(['error' => 'Failed to create reservations.']);
    }
}, 'post');
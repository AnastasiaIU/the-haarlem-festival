<?php

require_once(__DIR__ . '/../../src/controllers/BookingController.php');

$bookingConroller = new BookingController();

Route::add('/api/bookings', function () use ($bookingConroller) {
    header('Content-Type: application/json');

    $input = json_decode(file_get_contents('php://input'), true);
    $bookings = $input['bookings'];
    $receivingEmail = $input['receivingEmail'];

    $response = $bookingConroller->createBooking($bookings, $receivingEmail);

    echo json_encode($response);
}, 'post');
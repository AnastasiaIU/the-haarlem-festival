<?php

require_once(__DIR__ . '/../../src/controllers/BookingController.php');

$bookingConroller = new BookingController();

Route::add('/api/booking', function () use ($bookingConroller) {
    header('Content-Type: application/json');

    $input = json_decode(file_get_contents('php://input'), true);
    $recevingEmail = $input['receiving_email'];
    $ticketType = $input['ticket_type'];
    $ticketId = $input['ticket_id'];
    $quantity = $input['quantity'];

    $response = $bookingConroller->createBooking($recevingEmail, $ticketType, $ticketId, $quantity);

    echo json_encode(['created_booking' => $response]);
}, 'post');
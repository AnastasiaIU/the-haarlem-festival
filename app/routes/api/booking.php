<?php

require_once(__DIR__ . '/../../src/controllers/BookingController.php');
require_once(__DIR__ . '/../../src/controllers/UserController.php');

$bookingConroller = new BookingController();

Route::add('/api/bookings', function () use ($bookingConroller) {
    header('Content-Type: application/json');

    $input = json_decode(file_get_contents('php://input'), true);
    $bookings = $input['bookings'];
    $receivingEmail = $input['receivingEmail'];

    $response = null;

    if (isset($receivingEmail)) {
        $userController = new UserController();
        $userData = $userController->getUserInfoById($_SESSION['user']);
        $response = $bookingConroller->createBooking($bookings, $userData['email']);
    } else {
        $response = $bookingConroller->createBooking($bookings, $receivingEmail);
    }

    echo json_encode($response);
}, 'post');

Route::add('/api/bookings/([0-9]+)', function ($id) use ($bookingConroller) {
    header('Content-Type: application/json');

    $response = $bookingConroller->getAvailability($id);
    echo json_encode($response);
});

Route::add('/api/bookings/tour-availability/([0-9]+)', function ($id) use ($bookingConroller) {
    header('Content-Type: application/json');

    $response = $bookingConroller->getTourAvailability($id);
    echo json_encode($response);
});

Route::add('/api/bookings/user', function () use ($bookingConroller) {
    header('Content-Type: application/json');
    
    $userId = $_SESSION['user'];
    $response = $bookingConroller->fetchBookingsByUserId($userId);
    echo json_encode($response);
});

Route::add('/api/bookings/allOrders', function () use ($bookingConroller) {
    header('Content-Type: application/json');

    $response = $bookingConroller->fetchAllOrders();

    echo json_encode($response);
});
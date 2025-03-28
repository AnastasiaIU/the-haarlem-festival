<?php

require_once(__DIR__ . '/../models/BookingModel.php');
require_once(__DIR__ . '/../services/NumberGeneratorHandler.php');

class BookingController {
    private $bookingModel;

    public function __construct() {
        $this->bookingModel = new BookingModel();
    }

    public function createBooking($bookings, $receivingEmail): ?array {
        $numberGeneratorHandler = new NumberGeneratorHandler();
        $orderNumber = $numberGeneratorHandler->generateNumber();
        $userId = $_SESSION['user'];

        return $this->bookingModel->createBookings($bookings, $orderNumber, $receivingEmail, $userId);
    }
}
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

    public function passesSold() {
        return $this->bookingModel->passesSold();
    }

    public function danceShowSold($ticketId) {
        return $this->bookingModel->danceShowSold($ticketId);
    }

    public function getAvailability($ticketId): bool {
        $danceShowData = $this->danceShowSold($ticketId);
        $capacity = $danceShowData['capacity'];
        $ticketsSold = $danceShowData['tickets_sold'];

        if (($capacity * 0.9) > $ticketsSold) {
            return true;
        }

        return false;
    }

    public function tourSold($ticketId): array {
        return $this->bookingModel->tourSold($ticketId);
    }

    public function getTourAvailability($ticketId): array {
        $tourData = $this->tourSold($ticketId);
        $capacity = $tourData['capacity'];
        $ticketsSold = $tourData['tickets_sold'];

        $individualTickets = $capacity > $ticketsSold;
        $familyTickets = ($capacity - $ticketsSold) >= 4;

        return [
            'individual' => $individualTickets,
            'family' => $familyTickets
        ];
    }

    public function fetchBookingsByUserId($userId): array {
        return $this->bookingModel->fetchBookingsByUserId($userId);
    }

    public function fetchAllOrders(): array {
        return $this->bookingModel->fetchAllOrders();
    }
}
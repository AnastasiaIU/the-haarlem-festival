<?php

require_once(__DIR__ . "/../models/ReservationModel.php");

class ReservationController {
    private $reservationModel;

    public function __construct() {
        $this->reservationModel = new ReservationModel();
    }

    public function createReservations(array $reservations): ?array {
        return $this->reservationModel->createReservations($reservations);
    }
}
<?php

require_once(__DIR__ . '/../models/PassModel.php');
require_once(__DIR__ . '/../dto/PassDTO.php');
require_once(__DIR__ . '/DanceShowController.php');
require_once(__DIR__ . '/BookingController.php');

/**
 * Controller class for handling pass-related operations for the DANCE! event.
 */
class PassController
{
    private PassModel $passModel;

    public function __construct()
    {
        $this->passModel = new PassModel();
    }

    /**
     * Fetches all passes from the database.
     *
     * @return array An array of pass objects.
     */
    public function fetchAllPasses(): array
    {
        return $this->passModel->fetchAllPasses();
    }

    public function passesAvailable(): array
    {
        $danceShowController = new DanceShowController();
        $bookingController = new BookingController();

        $danceShowAvailability = $danceShowController->danceShowAvailability();
        $passesSold = $bookingController->passesSold();

        $totalCapacity = 0;
        foreach ($danceShowAvailability as $showCapacity) {
            $totalCapacity += $showCapacity;
        }

        $capacityPerDate = [];
        foreach ($danceShowAvailability as $dateTime => $capacity) {
            $date = explode(' ', $dateTime)[0];
    
            if (!isset($capacityPerDate[$date])) {
                $capacityPerDate[$date] = 0;
            }
            $capacityPerDate[$date] += $capacity;
        }

        $canSell = ['All-Access' => ($totalCapacity * 0.10) > ($passesSold['All-Access'] ?? 0)];
        foreach ($capacityPerDate as $date => $capacity) {
            $dayName = new DateTime($date)->format('l');
            $canSell[$dayName] = ($capacity * 0.10) > ($passesSold[$dayName] ?? 0);
        }

        return $canSell;
    }
}

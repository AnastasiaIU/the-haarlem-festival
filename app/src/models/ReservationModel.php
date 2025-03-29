<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/ReservationDTO.php');

/**
 * ReservationModel class extends BaseModel to interact with the RESERVATION entity in the database.
 */
class ReservationModel extends BaseModel
{
    /**
     * Fetches all reservations for the restaurant by its id.
     *
     * @param int $restaurantId The id of the restaurant.
     * @return array An array of reservation objects.
     */
    public function fetchReservationForRestaurant(int $restaurantId): array
    {
        $query = self::$pdo->prepare(
            'SELECT id, restaurant_id, date_time, adults, kids, comment
        FROM reservation
        WHERE restaurant_id = :restaurantId'
        );
        $query->execute([':restaurantId' => $restaurantId]);
        $reservations = $query->fetchAll(PDO::FETCH_ASSOC);
        $dtos = [];

        foreach ($reservations as $reservation) {
            $dto = ReservationDTO::fromArray($reservation);
            $dtos[] = $dto;
        }

        return $dtos;
    }
}
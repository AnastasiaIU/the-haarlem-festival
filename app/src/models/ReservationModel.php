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

    public function createReservations(array $reservations): ?array
    {
        try {
            self::$pdo->beginTransaction();

            $query = self::$pdo->prepare(
                'INSERT INTO reservation (restaurant_id, date_time, adults, kids, comment) 
             VALUES (:restaurant_id, :date_time, :adults, :kids, :comment)'
            );

            $insertedIds = [];

            foreach ($reservations as $reservation) {
                $success = $query->execute([
                    ':restaurant_id' => $reservation['restaurantId'],
                    ':date_time' => $reservation['dateTime'],
                    ':adults' => $reservation['adults'],
                    ':kids' => $reservation['kids'],
                    ':comment' => $reservation['comment'] ?? null,
                ]);

                if (!$success) {
                    self::$pdo->rollBack();
                    return ['error' => 'Failed to create reservation. no success'];
                }

                $insertedIds[] = self::$pdo->lastInsertId();
            }

            self::$pdo->commit();

            return $insertedIds;
        } catch (Exception $e) {
            self::$pdo->rollBack();
            return ['error' => 'Failed to create reservation. Exception: ' . $e->getMessage()];
        }
    }
}
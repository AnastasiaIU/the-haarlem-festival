<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/ChefDTO.php');

/**
 * ChefModel class extends BaseModel to interact with the CHEF entity in the database.
 */
class ChefModel extends BaseModel
{
    /**
     * Fetches a chef by the restaurant.
     *
     * @param int $restaurantId The id of the restaurant.
     * @return ChefDTO|null The chef object if found, otherwise null.
     */
    public function fetchChefByRestaurant(int $restaurantId): ?ChefDTO
    {
        $query = self::$pdo->prepare(
            'SELECT id, restaurant_id, name, image, description
                    FROM chef
                    WHERE restaurant_id = :restaurantId'
        );

        $query->execute([':restaurantId' => $restaurantId]);
        $restaurant = $query->fetch(PDO::FETCH_ASSOC);

        if (!$restaurant) {
            return null;
        }

        return ChefDTO::fromArray($restaurant);
    }
}
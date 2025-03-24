<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/FoodTypeDTO.php');

/**
 * FoodTypeModel class extends BaseModel to interact with the FOOD TYPE entity in the database.
 */
class FoodTypeModel extends BaseModel
{
    /**
     * Fetches all food types from the database.
     *
     * @return array An array of food type objects.
     */
    public function fetchAllFoodTypes(): array
    {
        $query = self::$pdo->prepare(
            'SELECT id, name, icon, bg_color, text_color
                    FROM food_type'
        );
        $query->execute();
        $foodTypes = $query->fetchAll(PDO::FETCH_ASSOC);
        $dtos = [];

        foreach ($foodTypes as $foodType) {
            $dto = FoodTypeDTO::fromArray($foodType);
            $dtos[] = $dto;
        }

        return $dtos;
    }

    /**
     * Fetches all food types of the restaurant from the database.
     *
     * @return array An array of food type objects.
     */
    public function fetchFoodTypesForRestaurant(int $restaurantId): array
    {
        $query = self::$pdo->prepare(
            'SELECT id, name, icon, bg_color, text_color
                    FROM food_type
                    JOIN served_food ON id = food_id 
                    WHERE restaurant_id = :restaurant_id'
        );
        $query->execute([':restaurant_id' => $restaurantId]);
        $foodTypes = $query->fetchAll(PDO::FETCH_ASSOC);
        $dtos = [];

        foreach ($foodTypes as $foodType) {
            $dto = FoodTypeDTO::fromArray($foodType);
            $dtos[] = $dto;
        }

        return $dtos;
    }
}
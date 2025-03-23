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
}
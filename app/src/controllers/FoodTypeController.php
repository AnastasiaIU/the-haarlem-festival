<?php

require_once(__DIR__ . '/../models/FoodTypeModel.php');
require_once(__DIR__ . '/../dto/FoodTypeDTO.php');

/**
 * Controller class for handling food type-related operations.
 */
class FoodTypeController
{
    private FoodTypeModel $foodTypeModel;

    public function __construct()
    {
        $this->foodTypeModel = new FoodTypeModel();
    }

    /**
     * Fetches all food types from the database.
     *
     * @return array An array of food type objects.
     */
    public function fetchAllFoodTypes(): array
    {
        return $this->foodTypeModel->fetchAllFoodTypes();
    }
}
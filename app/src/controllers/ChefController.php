<?php

require_once(__DIR__ . '/../models/ChefModel.php');
require_once(__DIR__ . '/../dto/ChefDTO.php');

/**
 * Controller class for handling chef-related operations.
 */
class ChefController
{
    private ChefModel $chefModel;

    public function __construct()
    {
        $this->chefModel = new ChefModel();
    }

    /**
     * Fetches a chef by the restaurant.
     *
     * @param int $restaurantId The id of the restaurant.
     * @return ChefDTO|null The chef object if found, otherwise null.
     */
    public function fetchChefByRestaurant(int $restaurantId): ?ChefDTO
    {
        return $this->chefModel->fetchChefByRestaurant($restaurantId);
    }
}
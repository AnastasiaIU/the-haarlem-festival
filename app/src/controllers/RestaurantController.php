<?php

require_once(__DIR__ . '/../models/RestaurantModel.php');

/**
 * Controller class for handling restaurant-related operations.
 */
class RestaurantController
{
    private RestaurantModel $restaurantModel;

    public function __construct()
    {
        $this->restaurantModel = new RestaurantModel();
    }

    /**
     * Fetches all restaurants from the database.
     *
     * @return array An array of restaurant objects.
     */
    public function fetchAllRestaurants(): array
    {
        return $this->restaurantModel->fetchAllRestaurants();
    }

    /**
     * Fetches a single restaurant by its slug.
     *
     * @param string $slug The slug of the restaurant to fetch.
     * @return RestaurantDTO|null The restaurant object if found, otherwise null.
     */
    public function fetchRestaurantBySlug(string $slug): ?RestaurantDTO
    {
        return $this->restaurantModel->fetchRestaurantBySlug($slug);
    }
}
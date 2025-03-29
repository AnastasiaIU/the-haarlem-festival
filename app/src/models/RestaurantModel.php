<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/RestaurantDTO.php');
require_once(__DIR__ . '/FoodTypeModel.php');
require_once(__DIR__ . '/ReservationModel.php');

/**
 * RestaurantModel class extends BaseModel to interact with the RESTAURANT entity in the database.
 */
class RestaurantModel extends BaseModel
{
    /**
     * Fetches all restaurants from the database.
     *
     * @return array An array of restaurant objects.
     */
    public function fetchAllRestaurants(): array
    {
        $query = self::$pdo->prepare(
            'SELECT id, event_id, slug, name, address, stars, michelin, description, card_description, capacity, full_price, adult_price, kids_price, duration, sessions, first_session, menu, phone, email, start_date, end_date, carousel_image1, carousel_image2, carousel_image3, carousel_image4, carousel_image5, carousel_image6, image
                    FROM restaurant'
        );
        $query->execute();
        $restaurants = $query->fetchAll(PDO::FETCH_ASSOC);
        $dtos = [];

        $foodTypeModel = new FoodTypeModel();
        $reservationModel = new ReservationModel();

        foreach ($restaurants as $restaurant) {
            $foodTypes = $foodTypeModel->fetchFoodTypesForRestaurant($restaurant['id']);
            $reservations = $reservationModel->fetchReservationForRestaurant($restaurant['id']);
            $dto = RestaurantDTO::fromArray($restaurant, $foodTypes, $reservations);
            $dtos[] = $dto;
        }

        return $dtos;
    }

    /**
     * Fetches a single restaurant by its slug.
     *
     * @param string $slug The slug of the restaurant to fetch.
     * @return RestaurantDTO|null The restaurant object if found, otherwise null.
     */
    public function fetchRestaurantBySlug(string $slug): ?RestaurantDTO
    {
        $query = self::$pdo->prepare(
            'SELECT id, event_id, slug, name, address, stars, michelin, description, card_description, capacity, full_price, adult_price, kids_price, duration, sessions, first_session, menu, phone, email, start_date, end_date, carousel_image1, carousel_image2, carousel_image3, carousel_image4, carousel_image5, carousel_image6, image
        FROM restaurant
        WHERE slug = :slug'
        );
        $query->execute([':slug' => $slug]);
        $restaurant = $query->fetch(PDO::FETCH_ASSOC);

        if (!$restaurant) {
            return null;
        }

        $foodTypeModel = new FoodTypeModel();
        $foodTypes = $foodTypeModel->fetchFoodTypesForRestaurant($restaurant['id']);

        $reservationModel = new ReservationModel();
        $reservations = $reservationModel->fetchReservationForRestaurant($restaurant['id']);

        return RestaurantDTO::fromArray($restaurant, $foodTypes, $reservations);
    }
}
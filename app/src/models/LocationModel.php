<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/LocationDTO.php');

/**
 * LocationModel class extends BaseModel to interact with the LOCATION entity in the database.
 */
class LocationModel extends BaseModel
{
    /**
     * Fetches all location from the database.
     *
     * @return array An array of location objects.
     */
    public function fetchAllLocations(): array
    {
        $query = self::$pdo->prepare(
            'SELECT id, event_id, slug, name, address, description, card_description, image, card_image, carousel_image1, carousel_image2, carousel_image3, carousel_image4, carousel_image5, carousel_image6
                    FROM location'
        );
        $query->execute();
        $locations = $query->fetchAll(PDO::FETCH_ASSOC);
        $dtos = [];

        foreach ($locations as $location) {
            $dto = LocationDTO::fromArray($location);
            $dtos[] = $dto;
        }

        return $dtos;
    }

    /**
     * Fetches a single location by its slug.
     *
     * @param string $slug The slug of the location to fetch.
     * @return LocationDTO|null The location object if found, otherwise null.
     */
    public function fetchLocationBySlug(string $slug): ?LocationDTO
    {
        $query = self::$pdo->prepare(
            'SELECT id, event_id, slug, name, address, description, card_description, image, card_image, carousel_image1, carousel_image2, carousel_image3, carousel_image4, carousel_image5, carousel_image6
                    FROM location
                    WHERE slug = :slug'
        );

        $query->execute([':slug' => $slug]);
        $location = $query->fetch(PDO::FETCH_ASSOC);

        if (!$location) {
            return null;
        }

        return LocationDTO::fromArray($location);
    }
}
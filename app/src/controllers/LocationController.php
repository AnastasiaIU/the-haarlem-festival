<?php

require_once(__DIR__ . '/../models/LocationModel.php');
require_once(__DIR__ . '/../dto/LocationDTO.php');

/**
 * Controller class for handling location-related operations.
 */
class LocationController
{
    private LocationModel $locationModel;

    public function __construct()
    {
        $this->locationModel = new LocationModel();
    }

    /**
     * Fetches all location from the database.
     *
     * @return array An array of location objects.
     */
    public function fetchAllLocations(): array
    {
        return $this->locationModel->fetchAllLocations();
    }

    /**
     * Fetches a single location by its slug.
     *
     * @param string $slug The slug of the location to fetch.
     * @return LocationDTO|null The location object if found, otherwise null.
     */
    public function fetchLocationBySlug(string $slug): ?LocationDTO
    {
        return $this->locationModel->fetchLocationBySlug($slug);
    }
}
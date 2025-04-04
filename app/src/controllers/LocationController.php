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

    /**
     * Creates a new location.
     */
    public function createLocation(array $data): bool
    {
        return $this->locationModel->createLocation($data);
    }

    /**
     * Updates an existing location by ID.
     */
    public function updateLocation(int $id, array $data): bool
    {
    $result = $this->locationModel->updateLocation($id, $data);

    if ($result) {
        error_log("Update successful.");
    } else {
        error_log("Update failed.");
    }

    return $result;
    }

    /**
     * Deletes a location by ID.
     */
    public function deleteLocation(int $id): bool
    {
        return $this->locationModel->deleteLocation($id);
    }
}
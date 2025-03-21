<?php

require_once(__DIR__ . '/../models/VenueModel.php');
require_once(__DIR__ . '/../dto/VenueDTO.php');

/**
 * Controller class for handling venue-related operations.
 */
class VenueController
{
    private VenueModel $venueModel;

    public function __construct()
    {
        $this->venueModel = new VenueModel();
    }

    /**
     * Fetches a single venue entity by its id.
     *
     * @param int $id The id of the venue to fetch.
     * @return VenueDTO|null The venue object if found, otherwise null.
     */
    public function fetchVenueById(int $id): ?VenueDTO
    {
        return $this->venueModel->fetchVenueById($id);
    }
}
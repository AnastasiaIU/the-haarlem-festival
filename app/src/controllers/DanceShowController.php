<?php

require_once(__DIR__ . '/../models/DanceShowModel.php');
require_once(__DIR__ . '/../dto/DanceShowDTO.php');

/**
 * Controller class for handling dance show-related operations.
 */
class DanceShowController
{
    private DanceShowModel $showModel;

    public function __construct()
    {
        $this->showModel = new DanceShowModel();
    }

    /**
     * Fetches all dance shows from the database for the provided artist.
     *
     * @return array An array of dance show objects.
     */
    public function fetchAllShows(int $artistId): array
    {
        return $this->showModel->fetchAllShows($artistId);
    }
}
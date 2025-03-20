<?php

require_once(__DIR__ . '/../models/ArtistModel.php');
require_once(__DIR__ . '/../dto/ArtistDTO.php');

/**
 * Controller class for handling artist-related operations.
 */
class ArtistController
{
    private ArtistModel $artistModel;

    public function __construct()
    {
        $this->artistModel = new ArtistModel();
    }

    /**
     * Fetches all artists from the database.
     *
     * @return array An array of artist objects.
     */
    public function fetchAllArtists(): array
    {
        return $this->artistModel->fetchAllArtists();
    }

    /**
     * Fetches a single artist entity by its id.
     *
     * @param int $id The id of the artist to fetch.
     * @return EventDTO|null The artist object if found, otherwise null.
     */
    public function fetchArtistById(int $id): ?ArtistDTO
    {
        return $this->artistModel->fetchArtistById($id);
    }
}
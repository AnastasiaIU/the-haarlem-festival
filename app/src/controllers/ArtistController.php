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

    /**
     * Fetches a single artist by its slug.
     *
     * @param string $slug The slug of the artist to fetch.
     * @return ArtistDTO|null The artist object if found, otherwise null.
     */
    public function fetchArtistBySlug(string $slug): ?ArtistDTO
    {
        return $this->artistModel->fetchArtistBySlug($slug);
    }

    public function updateArtist(int $id, array $data){
        return $this->artistModel->updateArtist($id, $data);
    }

    public function createArtist(array $data){
        return $this->artistModel->createArtist($data);
    }

    public function deleteArtist(int $id){
        return $this->artistModel->deleteArtist($id);
    }
}
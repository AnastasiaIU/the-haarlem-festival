<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/VenueDTO.php');

/**
 * VenueModel class extends BaseModel to interact with the VENUE entity in the database.
 */
class VenueModel extends BaseModel
{
    /**
     * Fetches a single venue entity by its id.
     *
     * @param int $id The id of the venue to fetch.
     * @return VenueDTO|null The venue object if found, otherwise null.
     */
    public function fetchVenueById(int $id): ?VenueDTO
    {
        $query = self::$pdo->prepare(
            'SELECT id AS venue_id, name, address
        FROM venue
        WHERE id = :id'
        );

        $query->execute([':id' => $id]);
        $venue = $query->fetch(PDO::FETCH_ASSOC);

        if (!$venue) {
            return null;
        }

        return VenueDTO::fromArray($venue);
    }
}
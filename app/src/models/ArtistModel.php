<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/ArtistDTO.php');

/**
 * ArtistModel class extends BaseModel to interact with the ARTIST entity in the database.
 */
class ArtistModel extends BaseModel
{
    /**
     * Fetches all artists from the database.
     *
     * @return array An array of artist objects.
     */
    public function fetchAllArtists(): array
    {
        $query = self::$pdo->prepare(
            'SELECT id, event_id, slug, stage_name, genre, hero_description, card_description, image, card_image
                    FROM artist'
        );
        $query->execute();
        $artists = $query->fetchAll(PDO::FETCH_ASSOC);
        $dtos = [];

        foreach ($artists as $artist) {
            $dto = ArtistDTO::fromArray($artist);
            $dtos[] = $dto;
        }

        return $dtos;
    }

    /**
     * Fetches a single artist entity by its id.
     *
     * @param int $id The id of the artist to fetch.
     * @return EventDTO|null The artist object if found, otherwise null.
     */
    public function fetchArtistById(int $id): ?ArtistDTO
    {
        $query = self::$pdo->prepare(
            'SELECT id, event_id, slug, stage_name, genre, hero_description, card_description, image, card_image
        FROM artist
        WHERE id = :id'
        );

        $query->execute([':id' => $id]);
        $artist = $query->fetch(PDO::FETCH_ASSOC);

        if (!$artist) {
            return null;
        }

        return ArtistDTO::fromArray($artist);
    }

    /**
     * Fetches a single artist by its slug.
     *
     * @param string $slug The slug of the artist to fetch.
     * @return ArtistDTO|null The artist object if found, otherwise null.
     */
    public function fetchArtistBySlug(string $slug): ?ArtistDTO
    {
        $query = self::$pdo->prepare(
            'SELECT id, event_id, slug, stage_name, genre, hero_description, card_description, image, card_image
        FROM artist
        WHERE slug = :slug'
        );

        $query->execute([':slug' => $slug]);
        $artist = $query->fetch(PDO::FETCH_ASSOC);

        if (!$artist) {
            return null;
        }

        return ArtistDTO::fromArray($artist);
    }
}
<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . "/ParticipantModel.php");
require_once(__DIR__ . '/../dto/DanceShowDTO.php');

/**
 * DanceShowModel class extends BaseModel to interact with the DANCE SHOW entity in the database.
 */
class DanceShowModel extends BaseModel
{
    /**
     * Fetches all dance shows from the database for the provided artist by its slug.
     *
     * @param string $artistSlug The slug of the artist to fetch.
     * @return array An array of dance show objects.
     */
    public function fetchAllShows(string $artistSlug): array
    {
        $query = self::$pdo->prepare(
            'SELECT dance_show.id AS dance_show_id, venue_id, date_time, session, duration, capacity, price, description, name, address, artist_id AS id, event_id, slug, stage_name, genre, hero_description, card_description, image, card_image, carousel_image1, carousel_image2, carousel_image3, carousel_image4, carousel_image5, carousel_image6
                    FROM participant
                    JOIN dance_show ON participant.dance_show_id = dance_show.id
                    JOIN artist ON artist.id = participant.artist_id
                    JOIN venue ON venue.id = dance_show.venue_id
                    WHERE slug = :slug
                    ORDER BY date_time'
        );
        $query->execute([':slug' => $artistSlug]);
        $shows = $query->fetchAll(PDO::FETCH_ASSOC);
        $dtos = [];

        $participantModel = new ParticipantModel();

        foreach ($shows as $show) {
            $participants = $participantModel->fetchAllParticipants($show['dance_show_id']);
            $dto = DanceShowDTO::fromArray($show, $participants);
            $dtos[] = $dto;
        }

        return $dtos;
    }

    public function danceShowAvailability() {
        $query = self::$pdo->prepare('SELECT date_time, SUM(capacity) AS capacity FROM dance_show GROUP BY date_time');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $availability = [];
        foreach ($result as $row) {
            $availability[$row['date_time']] = $row['capacity'];
        }

        return $availability;
    }
}
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
     * Fetches all dance shows from the database for the provided artist.
     *
     * @return array An array of dance show objects.
     */
    public function fetchAllShows(int $artistId): array
    {
        $query = self::$pdo->prepare(
            'SELECT dance_show.id AS dance_show_id, venue_id, date_time, session, duration, capacity, price, description, name, address, artist_id AS id, event_id, slug, stage_name, genre, hero_description, card_description, image, card_image
                    FROM participant
                    JOIN dance_show ON participant.dance_show_id = dance_show.id
                    JOIN artist ON artist.id = participant.artist_id
                    JOIN venue ON venue.id = dance_show.venue_id
                    WHERE artist_id = :artistId'
        );
        $query->execute([':artistId' => $artistId]);
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
}
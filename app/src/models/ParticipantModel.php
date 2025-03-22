<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/ParticipantDTO.php');

/**
 * ParticipantModel class extends BaseModel to interact with the PARTICIPANT entity in the database.
 */
class ParticipantModel extends BaseModel
{
    /**
     * Fetches all participants from the database for the provided show.
     *
     * @return array An array of participant objects.
     */
    public function fetchAllParticipants(int $showId): array
    {
        $query = self::$pdo->prepare(
            'SELECT dance_show_id, artist_id AS id, event_id, slug, stage_name, genre, hero_description, card_description, image, card_image, carousel_image1, carousel_image2, carousel_image3, carousel_image4, carousel_image5, carousel_image6
                    FROM participant
                    JOIN artist ON artist.id = participant.artist_id
                    WHERE dance_show_id = :showId'
        );
        $query->execute([':showId' => $showId]);
        $participants = $query->fetchAll(PDO::FETCH_ASSOC);
        $dtos = [];

        foreach ($participants as $participant) {
            $dto = ParticipantDTO::fromArray($participant);
            $dtos[] = $dto;
        }

        return $dtos;
    }
}
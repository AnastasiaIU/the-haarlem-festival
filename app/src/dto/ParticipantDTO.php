<?php

require_once(__DIR__ . '/ArtistDTO.php');

/**
 * Data Transfer Object (DTO) for representing a participant in a dance show.
 */
class ParticipantDTO {
    private int $danceShowId;
    private ArtistDTO $artist;

    public function __construct(int $danceShowId, ArtistDTO $artist) {
        $this->danceShowId = $danceShowId;
        $this->artist = $artist;
    }

    /**
     * Converts the ParticipantDTO object to an associative array.
     *
     * @return array An associative array representing the ParticipantDTO object.
     */
    public function toArray(): array {
        return [
            'dance_show_id' => $this->danceShowId,
            'artist' => $this->artist->toArray()
        ];
    }

    /**
     * Creates a ParticipantDTO instance from an associative array.
     *
     * @param array $data The associative array containing participant data.
     * @return self A new instance of ParticipantDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['dance_show_id'],
            ArtistDTO::fromArray($data)
        );
    }
}
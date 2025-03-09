<?php

/**
 * Data Transfer Object (DTO) for representing a participant in a dance show.
 */
class ParticipantDTO {
    private int $danceShowId;
    private int $artistId;

    public function __construct(int $danceShowId, int $artistId) {
        $this->danceShowId = $danceShowId;
        $this->artistId = $artistId;
    }

    // Getters
    public function getDanceShowId(): int {
        return $this->danceShowId;
    }

    public function getArtistId(): int {
        return $this->artistId;
    }

    /**
     * Converts the ParticipantDTO object to an associative array.
     *
     * @return array An associative array representing the ParticipantDTO object.
     */
    public function toArray(): array {
        return [
            'dance_show_id' => $this->danceShowId,
            'artist_id' => $this->artistId
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
            $data['artist_id']
        );
    }
}
<?php

/**
 * Data Transfer Object (DTO) for representing a track.
 */
class TrackDTO {
    private int $id;
    private int $artistId;
    private string $name;
    private string $track;
    private int $length;
    private string $cover;

    public function __construct(int $id, int $artistId, string $name, string $track, int $length, string $cover) {
        $this->id = $id;
        $this->artistId = $artistId;
        $this->name = $name;
        $this->track = $track;
        $this->length = $length;
        $this->cover = $cover;
    }

    /**
     * Converts the TrackDTO object to an associative array.
     *
     * @return array An associative array representing the TrackDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'artist_id' => $this->artistId,
            'name' => $this->name,
            'track' => $this->track,
            'length' => $this->length,
            'cover' => $this->cover
        ];
    }

    /**
     * Creates a TrackDTO instance from an associative array.
     *
     * @param array $data The associative array containing track data.
     * @return self A new instance of TrackDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['artist_id'],
            $data['name'],
            $data['track'],
            $data['length'],
            $data['cover']
        );
    }
}
<?php

/**
 * Data Transfer Object (DTO) for representing an artist.
 */
class ArtistDTO {
    private int $id;
    private int $eventId;
    private string $slug;
    private string $stageName;
    private string $genre;
    private string $heroDescription;
    private string $cardDescription;
    private string $image;
    private string $cardImage;

    public function __construct(
        int $id, int $eventId, string $slug, string $stageName,
        string $genre, string $heroDescription, string $cardDescription,
        string $image, string $cardImage
    ) {
        $this->id = $id;
        $this->eventId = $eventId;
        $this->slug = $slug;
        $this->stageName = $stageName;
        $this->genre = $genre;
        $this->heroDescription = $heroDescription;
        $this->cardDescription = $cardDescription;
        $this->image = $image;
        $this->cardImage = $cardImage;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getEventId(): int {
        return $this->eventId;
    }

    public function getSlug(): string {
        return $this->slug;
    }

    public function getStageName(): string {
        return $this->stageName;
    }

    public function getGenre(): string {
        return $this->genre;
    }

    public function getHeroDescription(): string {
        return $this->heroDescription;
    }

    public function getCardDescription(): string {
        return $this->cardDescription;
    }

    public function getImage(): string {
        return $this->image;
    }

    public function getCardImage(): string {
        return $this->cardImage;
    }

    /**
     * Converts the ArtistDTO object to an associative array.
     *
     * @return array An associative array representing the ArtistDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'event_id' => $this->eventId,
            'slug' => $this->slug,
            'stage_name' => $this->stageName,
            'genre' => $this->genre,
            'hero_description' => $this->heroDescription,
            'card_description' => $this->cardDescription,
            'image' => $this->image,
            'card_image' => $this->cardImage
        ];
    }

    /**
     * Creates an ArtistDTO instance from an associative array.
     *
     * @param array $data The associative array containing artist data.
     * @return self A new instance of ArtistDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['event_id'],
            $data['slug'],
            $data['stage_name'],
            $data['genre'],
            $data['hero_description'],
            $data['card_description'],
            $data['image'],
            $data['card_image']
        );
    }
}
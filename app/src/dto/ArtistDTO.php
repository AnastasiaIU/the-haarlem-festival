<?php

/**
 * Data Transfer Object (DTO) for representing an artist.
 */
class ArtistDTO implements JsonSerializable
{
    private int $id;
    private int $eventId;
    private string $slug;
    private string $stageName;
    private string $genre;
    private string $heroDescription;
    private string $cardDescription;
    private string $image;
    private string $cardImage;
    private string $carouselImage1;
    private string $carouselImage2;
    private string $carouselImage3;
    private string $carouselImage4;
    private string $carouselImage5;
    private string $carouselImage6;

    public function __construct(
        int    $id, int $eventId, string $slug, string $stageName,
        string $genre, string $heroDescription, string $cardDescription,
        string $image, string $cardImage, string $carouselImage1, string $carouselImage2,
        string $carouselImage3, string $carouselImage4, string $carouselImage5, string $carouselImage6
    )
    {
        $this->id = $id;
        $this->eventId = $eventId;
        $this->slug = $slug;
        $this->stageName = $stageName;
        $this->genre = $genre;
        $this->heroDescription = $heroDescription;
        $this->cardDescription = $cardDescription;
        $this->image = $image;
        $this->cardImage = $cardImage;
        $this->carouselImage1 = $carouselImage1;
        $this->carouselImage2 = $carouselImage2;
        $this->carouselImage3 = $carouselImage3;
        $this->carouselImage4 = $carouselImage4;
        $this->carouselImage5 = $carouselImage5;
        $this->carouselImage6 = $carouselImage6;
    }

    /**
     * Converts the ArtistDTO object to an associative array.
     *
     * @return array An associative array representing the ArtistDTO object.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'event_id' => $this->eventId,
            'slug' => $this->slug,
            'stage_name' => $this->stageName,
            'genre' => $this->genre,
            'hero_description' => $this->heroDescription,
            'card_description' => $this->cardDescription,
            'image' => $this->image,
            'card_image' => $this->cardImage,
            'carousel_image1' => $this->carouselImage1,
            'carousel_image2' => $this->carouselImage2,
            'carousel_image3' => $this->carouselImage3,
            'carousel_image4' => $this->carouselImage4,
            'carousel_image5' => $this->carouselImage5,
            'carousel_image6' => $this->carouselImage6
        ];
    }

    /**
     * Creates an ArtistDTO instance from an associative array.
     *
     * @param array $data The associative array containing artist data.
     * @return self A new instance of ArtistDTO populated with the provided data.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['event_id'],
            $data['slug'],
            $data['stage_name'],
            $data['genre'],
            $data['hero_description'],
            $data['card_description'],
            $data['image'],
            $data['card_image'],
            $data['carousel_image1'],
            $data['carousel_image2'],
            $data['carousel_image3'],
            $data['carousel_image4'],
            $data['carousel_image5'],
            $data['carousel_image6']
        );
    }

    /**
     * Converts the ArtistDTO object to a JSON-serializable array.
     *
     * @return array A JSON-serializable array representing the ArtistDTO object.
     */
    public function jsonSerialize(): array
    {
        return self::toArray();
    }
}
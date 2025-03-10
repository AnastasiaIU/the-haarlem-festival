<?php

/**
 * Data Transfer Object (DTO) for representing an image.
 */
class ImageDTO {
    private int $id;
    private int $locationId;
    private string $image;

    public function __construct(int $id, int $locationId, string $image) {
        $this->id = $id;
        $this->locationId = $locationId;
        $this->image = $image;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getLocationId(): int {
        return $this->locationId;
    }

    public function getImage(): string {
        return $this->image;
    }

    /**
     * Converts the ImageDTO object to an associative array.
     *
     * @return array An associative array representing the ImageDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'location_id' => $this->locationId,
            'image' => $this->image
        ];
    }

    /**
     * Creates an ImageDTO instance from an associative array.
     *
     * @param array $data The associative array containing image data.
     * @return self A new instance of ImageDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['location_id'],
            $data['image']
        );
    }
}
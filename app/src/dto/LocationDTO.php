<?php

/**
 * Data Transfer Object (DTO) for representing a location.
 */
class LocationDTO {
    private int $id;
    private int $eventId;
    private string $slug;
    private string $name;
    private string $address;
    private string $description;
    private string $image;

    public function __construct(int $id, int $eventId, string $slug, string $name, string $address, string $description, string $image) {
        $this->id = $id;
        $this->eventId = $eventId;
        $this->slug = $slug;
        $this->name = $name;
        $this->address = $address;
        $this->description = $description;
        $this->image = $image;
    }

    /**
     * Converts the LocationDTO object to an associative array.
     *
     * @return array An associative array representing the LocationDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'event_id' => $this->eventId,
            'slug' => $this->slug,
            'name' => $this->name,
            'address' => $this->address,
            'description' => $this->description,
            'image' => $this->image
        ];
    }

    /**
     * Creates a LocationDTO instance from an associative array.
     *
     * @param array $data The associative array containing location data.
     * @return self A new instance of LocationDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['event_id'],
            $data['slug'],
            $data['name'],
            $data['address'],
            $data['description'],
            $data['image']
        );
    }
}
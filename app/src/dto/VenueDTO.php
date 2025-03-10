<?php

/**
 * Data Transfer Object (DTO) for representing a venue.
 */
class VenueDTO {
    private int $id;
    private string $name;
    private string $address;

    public function __construct(int $id, string $name, string $address) {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getAddress(): string {
        return $this->address;
    }

    /**
     * Converts the VenueDTO object to an associative array.
     *
     * @return array An associative array representing the VenueDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address
        ];
    }

    /**
     * Creates a VenueDTO instance from an associative array.
     *
     * @param array $data The associative array containing venue data.
     * @return self A new instance of VenueDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['name'],
            $data['address']
        );
    }
}
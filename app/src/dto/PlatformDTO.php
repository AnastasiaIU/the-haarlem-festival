<?php

/**
 * Data Transfer Object (DTO) for representing a platform.
 */
class PlatformDTO {
    private int $id;
    private string $name;

    public function __construct(int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * Converts the PlatformDTO object to an associative array.
     *
     * @return array An associative array representing the PlatformDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

    /**
     * Creates a PlatformDTO instance from an associative array.
     *
     * @param array $data The associative array containing platform data.
     * @return self A new instance of PlatformDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['name']
        );
    }
}
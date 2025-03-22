<?php

/**
 * Data Transfer Object (DTO) for representing a chef.
 */
class ChefDTO {
    private int $id;
    private int $restaurantId;
    private string $name;
    private string $image;
    private string $description;

    public function __construct(int $id, int $restaurantId, string $name, string $image, string $description) {
        $this->id = $id;
        $this->restaurantId = $restaurantId;
        $this->name = $name;
        $this->image = $image;
        $this->description = $description;
    }

    /**
     * Converts the ChefDTO object to an associative array.
     *
     * @return array An associative array representing the ChefDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'restaurant_id' => $this->restaurantId,
            'name' => $this->name,
            'image' => $this->image,
            'description' => $this->description
        ];
    }

    /**
     * Creates a ChefDTO instance from an associative array.
     *
     * @param array $data The associative array containing chef data.
     * @return self A new instance of ChefDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['restaurant_id'],
            $data['name'],
            $data['image'],
            $data['description']
        );
    }
}
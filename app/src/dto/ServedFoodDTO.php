<?php

/**
 * Data Transfer Object (DTO) for representing a served food.
 */
class ServedFoodDTO {
    private int $restaurantId;
    private int $foodId;

    public function __construct(int $restaurantId, int $foodId) {
        $this->restaurantId = $restaurantId;
        $this->foodId = $foodId;
    }

    // Getters
    public function getRestaurantId(): int {
        return $this->restaurantId;
    }

    public function getFoodId(): int {
        return $this->foodId;
    }

    /**
     * Converts the ServedFoodDTO object to an associative array.
     *
     * @return array An associative array representing the ServedFoodDTO object.
     */
    public function toArray(): array {
        return [
            'restaurant_id' => $this->restaurantId,
            'food_id' => $this->foodId
        ];
    }

    /**
     * Creates a ServedFoodDTO instance from an associative array.
     *
     * @param array $data The associative array containing served food data.
     * @return self A new instance of ServedFoodDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['restaurant_id'],
            $data['food_id']
        );
    }
}
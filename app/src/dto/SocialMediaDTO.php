<?php

/**
 * Data Transfer Object (DTO) for representing a social media link associated with a restaurant.
 */
class SocialMediaDTO {
    private int $id;
    private int $platformId;
    private int $restaurantId;
    private string $link;

    public function __construct(int $id, int $platformId, int $restaurantId, string $link) {
        $this->id = $id;
        $this->platformId = $platformId;
        $this->restaurantId = $restaurantId;
        $this->link = $link;
    }

    /**
     * Converts the SocialMediaDTO object to an associative array.
     *
     * @return array An associative array representing the SocialMediaDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'platform_id' => $this->platformId,
            'restaurant_id' => $this->restaurantId,
            'link' => $this->link
        ];
    }

    /**
     * Creates a SocialMediaDTO instance from an associative array.
     *
     * @param array $data The associative array containing social media data.
     * @return self A new instance of SocialMediaDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['platform_id'],
            $data['restaurant_id'],
            $data['link']
        );
    }
}
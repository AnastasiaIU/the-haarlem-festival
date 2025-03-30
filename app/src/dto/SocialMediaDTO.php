<?php

require_once(__DIR__ . '/../enums/Platform.php');

/**
 * Data Transfer Object (DTO) for representing a social media link associated with a restaurant.
 */
class SocialMediaDTO implements JsonSerializable {
    private int $id;
    private int $restaurantId;
    private Platform $platform;
    private string $link;

    public function __construct(int $id, int $restaurantId, Platform $platform, string $link) {
        $this->id = $id;
        $this->restaurantId = $restaurantId;
        $this->platform = $platform;
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
            'restaurant_id' => $this->restaurantId,
            'platform' => $this->platform->value,
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
        $platform = isset($data['platform']) ? Platform::from($data['platform']) : null;

        return new self(
            $data['id'],
            $data['restaurant_id'],
            $platform,
            $data['link']
        );
    }

    /**
     * Converts the SocialMediaDTO object to a JSON-serializable array.
     *
     * @return array A JSON-serializable array representing the SocialMediaDTO object.
     */
    public function jsonSerialize(): array
    {
        return self::toArray();
    }
}
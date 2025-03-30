<?php

require_once(__DIR__ . '/TitleDTO.php');

/**
 * Data Transfer Object (DTO) for representing a description.
 */
class DescriptionDTO implements JsonSerializable {
    private int $id;
    private int $locationId;
    private TitleDTO $title;
    private string $description;
    private int $displayOrder;

    public function __construct(int $id, int $locationId, TitleDTO $title, string $description, int $displayOrder) {
        $this->id = $id;
        $this->locationId = $locationId;
        $this->title = $title;
        $this->description = $description;
        $this->displayOrder = $displayOrder;
    }

    /**
     * Converts the DescriptionDTO object to an associative array.
     *
     * @return array An associative array representing the DescriptionDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'location_id' => $this->locationId,
            'title' => $this->title,
            'description' => $this->description,
            'display_order' => $this->displayOrder
        ];
    }

    /**
     * Creates a DescriptionDTO instance from an associative array.
     *
     * @param array $data The associative array containing description data.
     * @return self A new instance of DescriptionDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['location_id'],
            TitleDTO::fromArray($data),
            $data['description'],
            $data['display_order']
        );
    }

    /**
     * Converts the DescriptionDTO object to a JSON-serializable array.
     *
     * @return array A JSON-serializable array representing the DescriptionDTO object.
     */
    public function jsonSerialize(): array
    {
        return self::toArray();
    }
}
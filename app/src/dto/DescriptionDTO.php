<?php

/**
 * Data Transfer Object (DTO) for representing a description.
 */
class DescriptionDTO {
    private int $id;
    private int $locationId;
    private int $titleId;
    private string $description;
    private int $displayOrder;

    public function __construct(int $id, int $locationId, int $titleId, string $description, int $displayOrder) {
        $this->id = $id;
        $this->locationId = $locationId;
        $this->titleId = $titleId;
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
            'title_id' => $this->titleId,
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
            $data['title_id'],
            $data['description'],
            $data['display_order']
        );
    }
}
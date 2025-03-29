<?php

/**
 * Data Transfer Object (DTO) for representing a tour type.
 */
class TourTypeDTO implements JsonSerializable {
    private int $id;
    private int $capacity;
    private float $singlePrice;
    private float $familyPrice;

    public function __construct(int $id, int $capacity, float $singlePrice, float $familyPrice) {
        $this->id = $id;
        $this->capacity = $capacity;
        $this->singlePrice = $singlePrice;
        $this->familyPrice = $familyPrice;
    }

    /**
     * Converts the TourTypeDTO object to an associative array.
     *
     * @return array An associative array representing the TourTypeDTO object.
     */
    public function toArray(): array {
        return [
            'tour_type_id' => $this->id,
            'capacity' => $this->capacity,
            'single_price' => $this->singlePrice,
            'family_price' => $this->familyPrice
        ];
    }

    /**
     * Creates a TourTypeDTO instance from an associative array.
     *
     * @param array $data The associative array containing tour type data.
     * @return self A new instance of TourTypeDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['tour_type_id'],
            $data['capacity'],
            $data['single_price'],
            $data['family_price']
        );
    }

    /**
     * Converts the TourTypeDTO object to a JSON-serializable array.
     *
     * @return array A JSON-serializable array representing the TourTypeDTO object.
     */
    public function jsonSerialize(): array
    {
        return self::toArray();
    }
}
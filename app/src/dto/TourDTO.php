<?php

require_once(__DIR__ . '/TourTypeDTO.php');
require_once(__DIR__ . '/GuideDTO.php');

/**
 * Data Transfer Object (DTO) for representing a tour.
 */
class TourDTO implements JsonSerializable {
    private int $id;
    private GuideDTO $guide;
    private TourTypeDTO $tourType;
    private string $dateTime;

    public function __construct(int $id, GuideDTO $guide, TourTypeDTO $tourType, string $dateTime) {
        $this->id = $id;
        $this->guide = $guide;
        $this->tourType = $tourType;
        $this->dateTime = $dateTime;
    }

    /**
     * Converts the TourDTO object to an associative array.
     *
     * @return array An associative array representing the TourDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'guide' => $this->guide->toArray(),
            'tour_type' => $this->tourType->toArray(),
            'date_time' => $this->dateTime
        ];
    }

    /**
     * Creates a TourDTO instance from an associative array.
     *
     * @param array $data The associative array containing tour data.
     * @return self A new instance of TourDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            GuideDTO::fromArray($data),
            TourTypeDTO::fromArray($data),
            $data['date_time']
        );
    }

    /**
     * Converts the TourDTO object to a JSON-serializable array.
     *
     * @return array A JSON-serializable array representing the TourDTO object.
     */
    public function jsonSerialize(): array
    {
        return self::toArray();
    }
}
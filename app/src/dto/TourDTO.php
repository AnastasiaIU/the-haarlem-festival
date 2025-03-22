<?php

/**
 * Data Transfer Object (DTO) for representing a tour.
 */
class TourDTO {
    private int $id;
    private int $guideId;
    private int $tourTypeId;
    private string $dateTime;

    public function __construct(int $id, int $guideId, int $tourTypeId, string $dateTime) {
        $this->id = $id;
        $this->guideId = $guideId;
        $this->tourTypeId = $tourTypeId;
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
            'guide_id' => $this->guideId,
            'tour_type_id' => $this->tourTypeId,
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
            $data['guide_id'],
            $data['tour_id'],
            $data['date_time']
        );
    }
}
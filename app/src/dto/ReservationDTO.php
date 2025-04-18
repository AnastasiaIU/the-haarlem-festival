<?php

/**
 * Data Transfer Object (DTO) for representing a reservation.
 */
class ReservationDTO {
    private int $id;
    private int $restaurantId;
    private string $dateTime;
    private int $adults;
    private int $kids;
    private ?string $comment;

    public function __construct(int $id, int $restaurantId, string $dateTime, int $adults, int $kids, ?string $comment) {
        $this->id = $id;
        $this->restaurantId = $restaurantId;
        $this->dateTime = $dateTime;
        $this->adults = $adults;
        $this->kids = $kids;
        $this->comment = $comment;
    }

    /**
     * Converts the ReservationDTO object to an associative array.
     *
     * @return array An associative array representing the ReservationDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'restaurant_id' => $this->restaurantId,
            'date_time' => $this->dateTime,
            'adults' => $this->adults,
            'kids' => $this->kids,
            'comment' => $this->comment
        ];
    }

    /**
     * Creates a ReservationDTO instance from an associative array.
     *
     * @param array $data The associative array containing reservation data.
     * @return self A new instance of ReservationDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['restaurant_id'],
            $data['date_time'],
            $data['adults'],
            $data['kids'],
            $data['comment'] ?? null
        );
    }
}
<?php

require_once (__DIR__ . '/../enums/SessionType.php');

/**
 * Data Transfer Object (DTO) for representing a dance show.
 */
class DanceShowDTO {
    private int $id;
    private int $venueId;
    private string $dateTime;
    private SessionType $session;
    private string $duration;
    private int $capacity;
    private float $price;
    private string $description;

    public function __construct(int $id, int $venueId, string $dateTime, SessionType $session, string $duration, int $capacity, float $price, string $description) {
        $this->id = $id;
        $this->venueId = $venueId;
        $this->dateTime = $dateTime;
        $this->session = $session;
        $this->duration = $duration;
        $this->capacity = $capacity;
        $this->price = $price;
        $this->description = $description;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getVenueId(): int {
        return $this->venueId;
    }

    public function getDateTime(): string {
        return $this->dateTime;
    }

    public function getSession(): SessionType {
        return $this->session;
    }

    public function getDuration(): string {
        return $this->duration;
    }

    public function getCapacity(): int {
        return $this->capacity;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getDescription(): string {
        return $this->description;
    }

    /**
     * Converts the DanceShowDTO object to an associative array.
     *
     * @return array An associative array representing the DanceShowDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'venue_id' => $this->venueId,
            'date_time' => $this->dateTime,
            'session' => $this->session->value,
            'duration' => $this->duration,
            'capacity' => $this->capacity,
            'price' => $this->price,
            'description' => $this->description
        ];
    }

    /**
     * Creates a DanceShowDTO instance from an associative array.
     *
     * @param array $data The associative array containing dance show data.
     * @return self A new instance of DanceShowDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['venue_id'],
            $data['date_time'],
            SessionType::from($data['session']),
            $data['duration'],
            $data['capacity'],
            $data['price'],
            $data['description']
        );
    }
}
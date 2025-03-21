<?php

require_once(__DIR__ . '/../enums/SessionType.php');
require_once(__DIR__ . '/ParticipantDTO.php');

/**
 * Data Transfer Object (DTO) for representing a dance show.
 */
class DanceShowDTO implements JsonSerializable {
    private int $id;
    private int $venueId;
    private string $dateTime;
    private SessionType $session;
    private string $duration;
    private int $capacity;
    private float $price;
    private string $description;
    private array $participants;

    public function __construct(int $id, int $venueId, string $dateTime, SessionType $session, string $duration, int $capacity, float $price, string $description, array $participants) {
        $this->id = $id;
        $this->venueId = $venueId;
        $this->dateTime = $dateTime;
        $this->session = $session;
        $this->duration = $duration;
        $this->capacity = $capacity;
        $this->price = $price;
        $this->description = $description;
        $this->participants = $participants;
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

    public function getParticipants(): array {
        return $this->participants;
    }

    /**
     * Converts the DanceShowDTO object to an associative array.
     *
     * @return array An associative array representing the DanceShowDTO object.
     */
    public function toArray(): array {
        return [
            'dance_show_id' => $this->id,
            'venue_id' => $this->venueId,
            'date_time' => $this->dateTime,
            'session' => $this->session->value,
            'duration' => $this->duration,
            'capacity' => $this->capacity,
            'price' => $this->price,
            'description' => $this->description,
            'participants' => array_map(fn($p) => $p->toArray(), $this->participants)
        ];
    }

    /**
     * Creates a DanceShowDTO instance from an associative array.
     *
     * @param array $show The associative array containing dance show data.
     * @param array $artists An array of associative arrays, each representing an artist.
     * @return self A new instance of DanceShowDTO populated with the provided data.
     */
    public static function fromArray(array $show, array $artists): self {
        return new self(
            $show['dance_show_id'],
            $show['venue_id'],
            $show['date_time'],
            SessionType::from($show['session']),
            $show['duration'],
            $show['capacity'],
            $show['price'],
            $show['description'],
            $artists
        );
    }

    /**
     * Converts the DanceShowDTO object to a JSON-serializable array.
     *
     * @return array A JSON-serializable array representing the DanceShowDTO object.
     */
    public function jsonSerialize(): array
    {
        return [
            'dance_show_id' => $this->id,
            'venueId' => $this->venueId,
            'dateTime' => $this->dateTime,
            'session' => $this->session->value,
            'duration' => $this->duration,
            'capacity' => $this->capacity,
            'price' => $this->price,
            'description' => $this->description,
            'participants' => array_map(fn($p) => $p->toArray(), $this->participants)
        ];
    }
}
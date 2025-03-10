<?php

/**
 * Data Transfer Object (DTO) for representing a Teylers event.
 */
class TeylersEventDTO {
    private int $id;
    private int $showId;
    private string $startDateTime;
    private string $endDateTime;

    public function __construct(int $id, int $showId, string $startDateTime, string $endDateTime) {
        $this->id = $id;
        $this->showId = $showId;
        $this->startDateTime = $startDateTime;
        $this->endDateTime = $endDateTime;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getShowId(): int {
        return $this->showId;
    }

    public function getStartDateTime(): string {
        return $this->startDateTime;
    }

    public function getEndDateTime(): string {
        return $this->endDateTime;
    }

    /**
     * Converts the TeylersEventDTO object to an associative array.
     *
     * @return array An associative array representing the TeylersEventDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'show_id' => $this->showId,
            'start_date_time' => $this->startDateTime,
            'end_date_time' => $this->endDateTime
        ];
    }

    /**
     * Creates a TeylersEventDTO instance from an associative array.
     *
     * @param array $data The associative array containing Teylers event data.
     * @return self A new instance of TeylersEventDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['show_id'],
            $data['start_date_time'],
            $data['end_date_time']
        );
    }
}
<?php

/**
 * Data Transfer Object (DTO) for representing a schedule entry.
 */
class ScheduleDTO {
    private int $id;
    private string $date;
    private string $title;
    private string $startTime;
    private string $endTime;
    private string $titleColor;

    public function __construct(int $id, string $date, string $title, string $startTime, string $endTime, string $titleColor) {
        $this->id = $id;
        $this->date = $date;
        $this->title = $title;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->titleColor = $titleColor;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getDate(): string {
        return $this->date;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getStartTime(): string {
        return $this->startTime;
    }

    public function getEndTime(): string {
        return $this->endTime;
    }

    public function getTitleColor(): string {
        return $this->titleColor;
    }

    /**
     * Converts the ScheduleDTO object to an associative array.
     *
     * @return array An associative array representing the ScheduleDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'title' => $this->title,
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
            'title_color' => $this->titleColor
        ];
    }

    /**
     * Creates a ScheduleDTO instance from an associative array.
     *
     * @param array $data The associative array containing schedule data.
     * @return self A new instance of ScheduleDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['date'],
            $data['title'],
            $data['start_time'],
            $data['end_time'],
            $data['title_color']
        );
    }
}
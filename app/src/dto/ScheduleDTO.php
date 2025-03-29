<?php

/**
 * Data Transfer Object (DTO) for representing a schedule entry.
 */
class ScheduleDTO implements JsonSerializable {
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

    /**
     * Converts the ScheduleDTO object to a JSON-serializable array.
     *
     * @return array A JSON-serializable array representing the ScheduleDTO object.
     */
    public function jsonSerialize(): array
    {
        return self::toArray();
    }
}
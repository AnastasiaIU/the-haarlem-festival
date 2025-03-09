<?php

/**
 * Data Transfer Object (DTO) for representing a title.
 */
class TitleDTO {
    private int $id;
    private string $title;

    public function __construct(int $id, string $title) {
        $this->id = $id;
        $this->title = $title;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    /**
     * Converts the TitleDTO object to an associative array.
     *
     * @return array An associative array representing the TitleDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'title' => $this->title
        ];
    }

    /**
     * Creates a TitleDTO instance from an associative array.
     *
     * @param array $data The associative array containing title data.
     * @return self A new instance of TitleDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['title']
        );
    }
}
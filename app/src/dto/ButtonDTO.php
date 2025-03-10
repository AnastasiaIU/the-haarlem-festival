<?php

/**
 * Data Transfer Object (DTO) for representing a button.
 */
class ButtonDTO {
    private int $id;
    private int $typeId;
    private string $link;

    public function __construct(int $id, int $typeId, string $link) {
        $this->id = $id;
        $this->typeId = $typeId;
        $this->link = $link;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getTypeId(): int {
        return $this->typeId;
    }

    public function getLink(): string {
        return $this->link;
    }

    /**
     * Converts the ButtonDTO object to an associative array.
     *
     * @return array An associative array representing the ButtonDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'type_id' => $this->typeId,
            'link' => $this->link
        ];
    }

    /**
     * Creates a ButtonDTO instance from an associative array.
     *
     * @param array $data The associative array containing button data.
     * @return self A new instance of ButtonDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['type_id'],
            $data['link']
        );
    }
}
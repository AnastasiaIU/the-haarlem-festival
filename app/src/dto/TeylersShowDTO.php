<?php

/**
 * Data Transfer Object (DTO) for representing a Teylers show.
 */
class TeylersShowDTO {
    private int $id;
    private string $name;

    public function __construct(int $id, string $name) {
        $this->id = $id;
        $this->name = $name;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    /**
     * Converts the TeylersShowDTO object to an associative array.
     *
     * @return array An associative array representing the TeylersShowDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }

    /**
     * Creates a TeylersShowDTO instance from an associative array.
     *
     * @param array $data The associative array containing Teylers show data.
     * @return self A new instance of TeylersShowDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['name']
        );
    }
}
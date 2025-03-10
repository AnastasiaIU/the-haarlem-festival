<?php

/**
 * Data Transfer Object (DTO) for representing custom content.
 */
class CustomDTO {
    private int $id;
    private string $identifier;
    private string $content;

    public function __construct(int $id, string $identifier, string $content) {
        $this->id = $id;
        $this->identifier = $identifier;
        $this->content = $content;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getIdentifier(): string {
        return $this->identifier;
    }

    public function getContent(): string {
        return $this->content;
    }

    /**
     * Converts the CustomDTO object to an associative array.
     *
     * @return array An associative array representing the CustomDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'identifier' => $this->identifier,
            'content' => $this->content
        ];
    }

    /**
     * Creates a CustomDTO instance from an associative array.
     *
     * @param array $data The associative array containing custom content data.
     * @return self A new instance of CustomDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['identifier'],
            $data['content']
        );
    }
}
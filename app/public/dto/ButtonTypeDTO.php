<?php

/**
 * Data Transfer Object (DTO) for representing a button type.
 */
class ButtonTypeDTO {
    private int $id;
    private string $type;
    private string $text;
    private ?string $icon;

    public function __construct(int $id, string $type, string $text, ?string $icon) {
        $this->id = $id;
        $this->type = $type;
        $this->text = $text;
        $this->icon = $icon;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getType(): string {
        return $this->type;
    }

    public function getText(): string {
        return $this->text;
    }

    public function getIcon(): ?string {
        return $this->icon;
    }

    /**
     * Converts the ButtonTypeDTO object to an associative array.
     *
     * @return array An associative array representing the ButtonTypeDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'text' => $this->text,
            'icon' => $this->icon
        ];
    }

    /**
     * Creates a ButtonTypeDTO instance from an associative array.
     *
     * @param array $data The associative array containing button type data.
     * @return self A new instance of ButtonTypeDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['type'],
            $data['text'],
            $data['icon'] ?? null
        );
    }
}
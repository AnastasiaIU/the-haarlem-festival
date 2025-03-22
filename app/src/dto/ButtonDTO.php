<?php

/**
 * Data Transfer Object (DTO) for representing a button.
 */
class ButtonDTO implements JsonSerializable {
    private int $id;
    private int $typeId;
    private ?string $link;
    private string $type;
    private string $text;
    private ?string $icon;

    public function __construct(int $id, int $typeId, ?string $link, string $type, string $text, ?string $icon) {
        $this->id = $id;
        $this->typeId = $typeId;
        $this->link = $link;
        $this->type = $type;
        $this->text = $text;
        $this->icon = $icon;
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
            'link' => $this->link,
            'type' => $this->type,
            'text' => $this->text,
            'icon' => $this->icon
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
            $data['link'] ?? null,
            $data['type'],
            $data['text'],
            $data['icon'] ?? null
        );
    }

    /**
     * Converts the ButtonDTO object to a JSON-serializable array.
     *
     * @return array A JSON-serializable array representing the ButtonDTO object.
     */
    public function jsonSerialize(): array
    {
        return self::toArray();
    }
}
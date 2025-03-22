<?php

/**
 * Data Transfer Object (DTO) for representing a food type.
 */
class FoodTypeDTO implements JsonSerializable {
    private int $id;
    private string $name;
    private string $icon;
    private string $bgColor;
    private string $textColor;

    public function __construct(int $id, string $name, string $icon, string $bgColor, string $textColor) {
        $this->id = $id;
        $this->name = $name;
        $this->icon = $icon;
        $this->bgColor = $bgColor;
        $this->textColor = $textColor;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getIcon(): string {
        return $this->icon;
    }

    public function getBgColor(): string {
        return $this->bgColor;
    }

    public function getTextColor(): string {
        return $this->textColor;
    }

    /**
     * Converts the FoodTypeDTO object to an associative array.
     *
     * @return array An associative array representing the FoodTypeDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'icon' => $this->icon,
            'bg_color' => $this->bgColor,
            'text_color' => $this->textColor
        ];
    }

    /**
     * Creates a FoodTypeDTO instance from an associative array.
     *
     * @param array $data The associative array containing food type data.
     * @return self A new instance of FoodTypeDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['name'],
            $data['icon'],
            $data['bg_color'],
            $data['text_color']
        );
    }

    /**
     * Converts the FoodTypeDTO object to a JSON-serializable array.
     *
     * @return array A JSON-serializable array representing the FoodTypeDTO object.
     */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'icon' => $this->icon,
            'bgColor' => $this->bgColor,
            'textColor' => $this->textColor
        ];
    }
}
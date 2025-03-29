<?php

require_once(__DIR__ . '/LanguageDTO.php');

/**
 * Data Transfer Object (DTO) for representing a guide.
 */
class GuideDTO {
    private int $id;
    private LanguageDTO $language;
    private string $name;
    private string $description;
    private string $image;

    public function __construct(int $id, LanguageDTO $language, string $name, string $description, string $image) {
        $this->id = $id;
        $this->language = $language;
        $this->name = $name;
        $this->description = $description;
        $this->image = $image;
    }

    /**
     * Converts the GuideDTO object to an associative array.
     *
     * @return array An associative array representing the GuideDTO object.
     */
    public function toArray(): array {
        return [
            'guide_id' => $this->id,
            'language' => $this->language,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image
        ];
    }

    /**
     * Creates a GuideDTO instance from an associative array.
     *
     * @param array $data The associative array containing guide data.
     * @return self A new instance of GuideDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['guide_id'],
            LanguageDTO::fromArray($data),
            $data['name'],
            $data['description'],
            $data['image']
        );
    }
}
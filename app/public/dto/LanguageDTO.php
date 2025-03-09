<?php

/**
 * Data Transfer Object (DTO) for representing a language.
 */
class LanguageDTO {
    private int $id;
    private string $language;

    public function __construct(int $id, string $language) {
        $this->id = $id;
        $this->language = $language;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getLanguage(): string {
        return $this->language;
    }

    /**
     * Converts the LanguageDTO object to an associative array.
     *
     * @return array An associative array representing the LanguageDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'language' => $this->language
        ];
    }

    /**
     * Creates a LanguageDTO instance from an associative array.
     *
     * @param array $data The associative array containing language data.
     * @return self A new instance of LanguageDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['language']
        );
    }
}

<?php

/**
 * Data Transfer Object (DTO) for representing a language.
 */
class LanguageDTO implements JsonSerializable {
    private int $id;
    private string $language;

    public function __construct(int $id, string $language) {
        $this->id = $id;
        $this->language = $language;
    }

    /**
     * Converts the LanguageDTO object to an associative array.
     *
     * @return array An associative array representing the LanguageDTO object.
     */
    public function toArray(): array {
        return [
            'language_id' => $this->id,
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
            $data['language_id'],
            $data['language']
        );
    }

    /**
     * Converts the LanguageDTO object to a JSON-serializable array.
     *
     * @return array A JSON-serializable array representing the LanguageDTO object.
     */
    public function jsonSerialize(): array
    {
        return self::toArray();
    }
}

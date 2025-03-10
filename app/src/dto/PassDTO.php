<?php

require_once(__DIR__ . '/../enums/DayPass.php');

/**
 * Data Transfer Object (DTO) for representing a festival pass.
 */
class PassDTO {
    private int $id;
    private float $price;
    private DayPass $day;

    public function __construct(int $id, float $price, DayPass $day) {
        $this->id = $id;
        $this->price = $price;
        $this->day = $day;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getDay(): DayPass {
        return $this->day;
    }

    /**
     * Converts the PassDTO object to an associative array.
     *
     * @return array An associative array representing the PassDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'day' => $this->day->value
        ];
    }

    /**
     * Creates a PassDTO instance from an associative array.
     *
     * @param array $data The associative array containing pass data.
     * @return self A new instance of PassDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['price'],
            DayPass::from($data['day'])
        );
    }
}
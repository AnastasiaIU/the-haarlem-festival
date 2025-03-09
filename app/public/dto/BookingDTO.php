<?php

require_once (__DIR__ . '/../enums/TicketType.php');

/**
 * Data Transfer Object (DTO) for representing a booking.
 */
class BookingDTO {
    private int $id;
    private int $userId;
    private TicketType $ticketType;
    private int $ticketId;
    private int $quantity;

    public function __construct(int $id, int $userId, TicketType $ticketType, int $ticketId, int $quantity) {
        $this->id = $id;
        $this->userId = $userId;
        $this->ticketType = $ticketType;
        $this->ticketId = $ticketId;
        $this->quantity = $quantity;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function getTicketType(): TicketType {
        return $this->ticketType;
    }

    public function getTicketId(): int {
        return $this->ticketId;
    }

    public function getQuantity(): int {
        return $this->quantity;
    }

    /**
     * Converts the BookingDTO object to an associative array.
     *
     * @return array An associative array representing the BookingDTO object.
     */
    public function toArray(): array {
        return [
            'id' => $this->id,
            'user_id' => $this->userId,
            'ticket_type' => $this->ticketType->value,
            'ticket_id' => $this->ticketId,
            'quantity' => $this->quantity
        ];
    }

    /**
     * Creates a BookingDTO instance from an associative array.
     *
     * @param array $data The associative array containing booking data.
     * @return self A new instance of BookingDTO populated with the provided data.
     */
    public static function fromArray(array $data): self {
        return new self(
            $data['id'],
            $data['user_id'],
            TicketType::from($data['ticket_type']),
            $data['ticket_id'],
            $data['quantity']
        );
    }
}
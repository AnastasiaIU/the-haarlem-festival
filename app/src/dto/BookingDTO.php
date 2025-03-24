<?php

require_once(__DIR__ . '/../enums/TicketType.php');

/**
 * Data Transfer Object (DTO) for representing a booking.
 */
class BookingDTO {
    private int $id;
    private string $orderNumber;
    private int $userId;
    private string $name;
    private string $receivingEmail;
    private TicketType $ticketType;
    private int $ticketId;
    private int $quantity;

    public function __construct(int $id, string $orderNumber, int $userId, string $name, string $receivingEmail, TicketType $ticketType, int $ticketId, int $quantity) {
        $this->id = $id;
        $this->orderNumber = $orderNumber;
        $this->userId = $userId;
        $this->name = $name;
        $this->receivingEmail = $receivingEmail;
        $this->ticketType = $ticketType;
        $this->ticketId = $ticketId;
        $this->quantity = $quantity;
    }

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getOrderNumber(): string {
        return $this->orderNumber;
    }

    public function getUserId(): int {
        return $this->userId;
    }

    public function getReceivingEmail(): string {
        return $this->receivingEmail;
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
            'order_number' => $this->orderNumber,
            'user_id' => $this->userId,
            'name' => $this->name,
            'receiving_email' => $this->receivingEmail,
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
            $data['order_number'],
            $data['user_id'],
            $data['name'],
            $data['receiving_email'],
            TicketType::from($data['ticket_type']),
            $data['ticket_id'],
            $data['quantity']
        );
    }
}
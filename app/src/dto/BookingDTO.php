<?php

require_once(__DIR__ . '/../enums/TicketType.php');
require_once(__DIR__ . '/../enums/TicketSubType.php');

/**
 * Data Transfer Object (DTO) for representing a booking.
 */
class BookingDTO implements JsonSerializable
{
    private int $id;
    private string $orderNumber;
    private int $userId;
    private string $receivingEmail;
    private TicketType $ticketType;
    private ?TicketSubType $ticketSubType;
    private int $ticketId;
    private int $quantity;

    public function __construct(int $id, string $orderNumber, int $userId, string $receivingEmail, TicketType $ticketType, int $ticketId, int $quantity, ?TicketSubType $ticketSubType = null)
    {
        $this->id = $id;
        $this->orderNumber = $orderNumber;
        $this->userId = $userId;
        $this->receivingEmail = $receivingEmail;
        $this->ticketType = $ticketType;
        $this->ticketSubType = $ticketSubType;
        $this->ticketId = $ticketId;
        $this->quantity = $quantity;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getOrderNumber(): string
    {
        return $this->orderNumber;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getReceivingEmail(): string
    {
        return $this->receivingEmail;
    }

    public function getTicketType(): TicketType
    {
        return $this->ticketType;
    }

    public function getTicketId(): int
    {
        return $this->ticketId;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Converts the BookingDTO object to an associative array.
     *
     * @return array An associative array representing the BookingDTO object.
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'order_number' => $this->orderNumber,
            'user_id' => $this->userId,
            'receiving_email' => $this->receivingEmail,
            'ticket_type' => $this->ticketType->value,
            'ticket_id' => $this->ticketId,
            'quantity' => $this->quantity,
            'ticket_subtype' => $this->ticketSubType ? $this->ticketSubType->value : null
        ];
    }

    /**
     * Creates a BookingDTO instance from an associative array.
     *
     * @param array $data The associative array containing booking data.
     * @return self A new instance of BookingDTO populated with the provided data.
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['order_number'],
            $data['user_id'],
            $data['receiving_email'],
            TicketType::from($data['ticket_type']),
            $data['ticket_id'],
            $data['quantity'],
            $data['ticket_subtype'] ? TicketSubType::from($data['ticket_subtype']) : null
        );
    }

    /**
     * Converts the ArtistDTO object to a JSON-serializable array.
     *
     * @return array A JSON-serializable array representing the ArtistDTO object.
     */
    public function jsonSerialize(): array
    {
        return self::toArray();
    }
}

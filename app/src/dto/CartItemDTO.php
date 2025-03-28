<?php

require_once(__DIR__ . '/../enums/TicketType.php');

class CartItemDTO
{
    private string $cartItemName;
    private TicketType $cartItemType;
    private ?TicketSubType $cartItemSubType;
    private int $ticketId;
    private DateTime $date;
    private float $price;
    private string $imagePath;

    public function __construct(string $cartItemName, TicketType $cartItemType, int $ticketId, DateTime $date, float $price, string $imagePath, ?TicketSubType $cartItemSubType = null)
    {
        $this->cartItemName = $cartItemName;
        $this->cartItemType = $cartItemType;
        $this->cartItemSubType = $cartItemSubType;
        $this->ticketId = $ticketId;
        $this->date = $date;
        $this->price = $price;
        $this->imagePath = $imagePath;
    }

    public function toArray(): array {
        return [
            'item_name' => $this->cartItemName,
            'item_type' => $this->cartItemType->value,
            'item_sub_type' => $this->cartItemSubType ? $this->cartItemSubType->value : null,
            'ticket_id' => $this->ticketId,
            'date' => $this->date->format('Y-m-d H:i:s'),
            'price' => $this->price,
            'image_path' => $this->imagePath
        ];
    }

    public static function fromArray(array $data, TicketType $ticketType): self
    {
        return new self(
            $data['item_name'],
            $ticketType,
            $data['ticket_id'],
            new DateTime($data['date']),
            $data['price'],
            $data['image_path'],
            isset($data['item_sub_type']) && $data['item_sub_type'] ? TicketSubType::from($data['item_sub_type']) : null
        );
    }
}

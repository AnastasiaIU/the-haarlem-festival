<?php

require_once(__DIR__ . '/BaseModel.php');
require_once(__DIR__ . '/../dto/CartItemDTO.php');
require_once(__DIR__ . '/../enums/TicketType.php');

class CartItemModel extends BaseModel
{
    private const PASS_QUERY = "SELECT p.id AS ticket_id, p.name AS item_name, p.price, p.start_date AS date, e.image AS image_path FROM pass AS p JOIN event AS e ON e.id = p.event_id WHERE p.id = :id";
    private const DANCE_SHOW_QUERY = "SELECT d.id AS ticket_id, d.price, d.date_time AS date, a.stage_name AS item_name, e.image AS image_path FROM dance_show AS d JOIN participant AS p ON d.id = p.dance_show_id JOIN artist AS a ON a.id = p.artist_id JOIN event AS e ON e.id = a.event_id WHERE d.id = :id AND a.slug = :slug";
    private const RESTAURANT_QUERY = "SELECT e.image FROM event AS e JOIN restaurant AS r ON e.id = r.event_id WHERE r.id = :id";

    private function fetchCartItem(string $query, TicketType $ticketType, array $parameters): ?CartItemDTO
    {
        $query = self::$pdo->prepare($query);
        $query->execute($parameters);
        $cartItem = $query->fetch(PDO::FETCH_ASSOC);

        if (!$cartItem) {
            return null;
        }

        return CartItemDTO::fromArray($cartItem, $ticketType);
    }

    private function setParameters(array $data): array
    {
        $parameters = [];
        foreach ($data as $key => $value) {
            $parameters[":$key"] = $value;
        }
        return $parameters;
    }

    public function fetchPassCartItem(int $id): ?CartItemDTO
    {
        $parameters = $this->setParameters(['id' => $id]);
        return $this->fetchCartItem(self::PASS_QUERY, TicketType::PASS, $parameters);
    }

    public function fetchDanceShowItem(int $id, string $slug): ?CartItemDTO
    {
        $parameters = $this->setParameters(['id' => $id, 'slug' => $slug]);
        return $this->fetchCartItem(self::DANCE_SHOW_QUERY, TicketType::DANCE_SHOW, $parameters);
    }

    public function fetchRestaurantCartItem(int $id): ?array {
        $parameters = $this->setParameters(['id' => $id]);
        $query = self::$pdo->prepare(self::RESTAURANT_QUERY);
        $query->execute($parameters);
        $cartItem = $query->fetch(PDO::FETCH_ASSOC);

        if (!$cartItem) {
            return null;
        }

        return ['image' => $cartItem['image'], 'type' => TicketType::RESERVATION];
    }
}
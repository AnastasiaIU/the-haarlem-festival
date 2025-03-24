<?php

require_once(__DIR__ . '/BaseModel.php');

class BookingModel extends BaseModel {
    public function createBooking(string $orderNumber, int $userId, string $receivingEmail, TicketType $ticketType, int $ticketId, int $quantity): ?BookingDTO {
        try {
            self::$pdo->beginTransaction();

            $query = self::$pdo->prepare('INSERT INTO booking (order_number, user_id, receiving_email, ticket_type, ticket_id, quantity) VALUES (:order_number, :user_id, :receiving_email, :ticket_type, :ticket_id, :quantity)');

            $success = $query->execute([
                ':order_number' => $orderNumber,
                ':user_id' => $userId,
                ':receiving_email' => $receivingEmail,
                ':ticket_type' => $ticketType->value,
                ':ticket_id' => $ticketId,
                ':quantity' => $quantity
            ]);

            if (!$success) {
                self::$pdo->rollBack();
                return null;
            }

            $bookingId = self::$pdo->lastInsertId();

            self::$pdo->commit();

            return BookingDTO::fromArray([
                'id' => $bookingId,
                'order_number' => $orderNumber,
                'user_id' => $userId,
                'receiving_email' => $receivingEmail,
                'ticket_type' => $ticketType->value,
                'ticket_id' => $ticketId,
                'quantity' => $quantity
            ]);
            
        } catch (Exception $e) {
            self::$pdo->rollBack();
            return null;
        }
    }
}
<?php

require_once(__DIR__ . '/BaseModel.php');
require_once(__DIR__ . '/../dto/BookingDTO.php');

class BookingModel extends BaseModel
{
    public function createBookings($bookings, $orderNumber, $receivingEmail, $userId): ?array
    {
        try {
            self::$pdo->beginTransaction();

            $query = self::$pdo->prepare('INSERT INTO booking (order_number, user_id, receiving_email, ticket_type, ticket_subtype, ticket_id, quantity) VALUES (:order_number, :user_id, :receiving_email, :ticket_type, :ticket_subtype, :ticket_id, :quantity)');

            foreach ($bookings as $booking) {
                $success = $query->execute([
                    ':order_number' => $orderNumber,
                    ':user_id' => $userId,
                    ':receiving_email' => $receivingEmail,
                    ':ticket_type' => $booking['ticketType'],
                    ':ticket_subtype' => $booking['ticketSubType'],
                    ':ticket_id' => $booking['ticketId'],
                    ':quantity' => $booking['quantity']
                ]);
            }

            if (!$success) {
                self::$pdo->rollBack();
                return ['error' => 'Failed to create booking. no success'];
            }

            self::$pdo->commit();
            return ['order_number' => $orderNumber, 'receiving_email' => $receivingEmail];
        } catch (Exception $e) {
            self::$pdo->rollBack();
            return ['error' => 'Failed to create booking. Exception: ' . $e->getMessage()];
        }
    }

    public function passesSold()
    {
        $query = self::$pdo->prepare('SELECT pass.day AS day, SUM(quantity) AS passes_sold FROM booking JOIN pass ON booking.ticket_id = pass.id GROUP BY pass.day');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $passesSold = [];
        foreach ($result as $row) {
            $passesSold[$row['day']] = $row['passes_sold'];
        }

        return $passesSold;
    }

    public function danceShowSold($ticketId)
    {
        $query = self::$pdo->prepare('SELECT SUM(booking.quantity) AS tickets_sold, dance_show.capacity FROM dance_show LEFT JOIN booking ON booking.ticket_id = dance_show.id WHERE dance_show.id = :ticket_id');
        $query->execute([':ticket_id' => $ticketId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return [
            'tickets_sold' => $result['tickets_sold'] ?? 0,
            'capacity' => $result['capacity'] ?? 0
        ];
    }

    public function tourSold($ticketId): array
    {
        $query = self::$pdo->prepare('
        SELECT 
            SUM(
                CASE 
                    WHEN booking.ticket_subtype = "family" THEN booking.quantity * 4
                    ELSE booking.quantity
                END
            ) AS tickets_sold, 
            tour_type.capacity 
        FROM tour 
        LEFT JOIN booking 
            ON booking.ticket_id = tour.id AND booking.ticket_type = "tour"
        LEFT JOIN tour_type 
            ON tour.tour_id = tour_type.id 
        WHERE tour.id = :ticket_id
    ');
        $query->execute([':ticket_id' => $ticketId]);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        return [
            'tickets_sold' => $result['tickets_sold'] ?? 0,
            'capacity' => $result['capacity'] ?? 0
        ];
    }

    public function fetchBookingsByUserId($userId): array
    {
        $query = self::$pdo->prepare('SELECT *, name AS user_name FROM booking JOIN user ON user.id = user_id WHERE user_id = :user_id');
        $query->execute([':user_id' => $userId]);
        $bookings = $query->fetchAll(PDO::FETCH_ASSOC);

        $dtos = [];
        foreach ($bookings as $booking) {
            $dto = BookingDTO::fromArray($booking);
            $dtos[] = ['booking' => $dto, 'user_name' => $booking['user_name']];
        }

        return $dtos;
    }
}

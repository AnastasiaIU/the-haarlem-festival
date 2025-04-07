<?php

require_once(__DIR__ . '/BaseModel.php');

class TeylersEventModel extends BaseModel {
    public function fetchTeylersEventByDate(DateTime $date): ?array {
        $stmt = self::$pdo->prepare("SELECT * FROM teylers_event WHERE start_date_time = :date");
        $stmt->execute([':date' => $date->format('Y-m-d H:i:s')]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt) {
            return ['ticket_id' => $result['id'], 'ticket_type' => TicketType::TEYLERS_EVENT];
        }

        return null;
    }
}
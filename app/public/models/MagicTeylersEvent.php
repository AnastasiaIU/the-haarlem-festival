<?php

require_once __DIR__ . '/BaseModel.php';

class MagicTeylersEvent extends BaseModel
{
    public function getEventDetails(): array
    {
        try {
            $sql = "SELECT * FROM events WHERE event_slug = :slug LIMIT 1";
            $stmt = self::$pdo->prepare($sql);
            $stmt->execute(['slug' => 'teylers']);

            $result = $stmt->fetch();
            
            if (!$result) {
                return [];
            }

            return $result;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            throw $e;
        }
    }
}

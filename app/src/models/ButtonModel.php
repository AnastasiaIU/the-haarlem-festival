<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/ButtonDTO.php');

/**
 * ButtonModel class extends BaseModel to manage buttons in the database.
 */
class ButtonModel extends BaseModel
{
    /**
     * Fetches a single button by its id.
     *
     * @param int $id The id of the button to fetch.
     * @return ButtonDTO|null The button object if found, otherwise null.
     */
    public function fetchButtonById(int $id): ?ButtonDTO
    {
        $query = self::$pdo->prepare(
            'SELECT b.id AS id, bt.id AS type_id, link, type, text, icon
        FROM button AS b
        JOIN button_type AS bt ON b.type_id = bt.id
        WHERE b.id = :id'
        );

        $query->execute([':id' => $id]);
        $button = $query->fetch(PDO::FETCH_ASSOC);

        if (!$button) {
            return null;
        }

        return ButtonDTO::fromArray($button);
    }
}
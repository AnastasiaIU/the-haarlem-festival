<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/EventDTO.php');

/**
 * EventModel class extends BaseModel to interact with the EVENT entity in the database.
 */
class EventModel extends BaseModel
{
    /**
     * Fetches all events from the database.
     *
     * @return array An array of event objects.
     */
    public function fetchAllEvents(): array
    {
        $query = self::$pdo->prepare(
            'SELECT id, slug, menu_name, hero_title, hero_subtitle, hero_description, title, subtitle, home_page_title, home_page_description, image, shape
                    FROM event'
        );
        $query->execute();
        $events = $query->fetchAll(PDO::FETCH_ASSOC);
        $dtos = [];

        foreach ($events as $event) {
            $dto = new EventDTO(
                $event['id'],
                $event['slug'],
                $event['menu_name'],
                $event['hero_title'],
                $event['hero_subtitle'],
                $event['hero_description'],
                $event['title'],
                $event['subtitle'],
                $event['home_page_title'],
                $event['home_page_description'],
                $event['image'],
                $event['shape']
            );
            $dtos[] = $dto;
        }

        return $dtos;
    }
}
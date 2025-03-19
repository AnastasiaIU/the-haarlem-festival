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
            $dto = EventDTO::fromArray($event);
            $dtos[] = $dto;
        }

        return $dtos;
    }

    /**
     * Fetches a single event by its id.
     *
     * @param int $id The id of the event to fetch.
     * @return EventDTO|null The event object if found, otherwise null.
     */
    public function fetchEventById(int $id): ?EventDTO
    {
        $query = self::$pdo->prepare(
            'SELECT id, slug, menu_name, hero_title, hero_subtitle, hero_description, title, subtitle, home_page_title, home_page_description, image, shape
        FROM event
        WHERE id = :id'
        );

        $query->execute([':id' => $id]);
        $event = $query->fetch(PDO::FETCH_ASSOC);

        if (!$event) {
            return null;
        }

        return EventDTO::fromArray($event);
    }

    /**
     * Fetches a single event by its slug.
     *
     * @param string $slug The slug of the event to fetch.
     * @return EventDTO|null The event object if found, otherwise null.
     */
    public function fetchEventBySlug(string $slug): ?EventDTO
    {
        $query = self::$pdo->prepare(
            'SELECT id, slug, menu_name, hero_title, hero_subtitle, hero_description, title, subtitle, home_page_title, home_page_description, image, shape
        FROM event
        WHERE slug = :slug'
        );

        $query->execute([':slug' => $slug]);
        $event = $query->fetch(PDO::FETCH_ASSOC);

        if (!$event) {
            return null;
        }

        return EventDTO::fromArray($event);
    }
}
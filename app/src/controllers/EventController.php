<?php

require_once(__DIR__ . '/../models/EventModel.php');
require_once(__DIR__ . '/../dto/EventDTO.php');

class EventController
{
    private EventModel $eventModel;

    public function __construct()
    {
        $this->eventModel = new EventModel();
    }

    /**
     * Fetches all events from the database.
     *
     * @return array An array of event objects.
     */
    public function fetchAllEvents(): array
    {
        return $this->eventModel->fetchAllEvents();
    }

    /**
     * Fetches a single event by its slug.
     *
     * @param string $slug The slug of the event to fetch.
     * @return EventDTO|null The event object if found, otherwise null.
     */
    public function fetchEventBySlug(string $slug): ?EventDTO
    {
        return $this->eventModel->fetchEventBySlug($slug);
    }

    /**
     * Fetches a single event by its id.
     *
     * @param int $id The id of the event to fetch.
     * @return EventDTO|null The event object if found, otherwise null.
     */
    public function fetchEventById(int $id): ?EventDTO
    {
        return $this->eventModel->fetchEventById($id);
    }
}
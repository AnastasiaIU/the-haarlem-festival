<?php

require_once(__DIR__ . '/../models/EventModel.php');
require_once(__DIR__ . '/../dto/EventDTO.php');

class EventController
{
    private EventModel $eventModel;

    public function __construct()
    {
        $this->eventModel = new eventModel();
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
}
<?php

require_once(__DIR__ . '/../../src/controllers/EventController.php');

Route::add('/api/getEvents', function () {
    $eventController = new EventController();
    $events = $eventController->fetchAllEvents();
    echo json_encode($events);
});

Route::add('/api/getEventBySlug/([a-zA-Z0-9_-]*)', function ($eventSlug) {
    $eventController = new EventController();
    $event = $eventController->fetchEventBySlug($eventSlug);
    echo json_encode($event);
});

Route::add('/api/getEventById/([0-9]+)', function ($eventId) {
    $eventController = new EventController();
    $event = $eventController->fetchEventById($eventId);
    echo json_encode($event);
});

Route::add('/api/getHomepage', function () {
    $eventController = new EventController();
    $homepageEvent = $eventController->fetchEventById(1); 
    echo json_encode($homepageEvent);
});
<?php

require_once(__DIR__ . '/../../src/controllers/TeylersEventController.php');

Route::add('/api/teylers-event', function () {
    header('Content-Type: application/json');
    $dateTime = $_GET['dateTime'] ?? null; 

    $teylersEventController = new TeylersEventController();
    $response = $teylersEventController->getTeylersEventByDate(new DateTime($dateTime));

    echo json_encode($response);
});
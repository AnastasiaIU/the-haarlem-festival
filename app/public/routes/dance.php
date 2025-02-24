<?php
require_once(__DIR__ . '/../controllers/DanceEventController.php');

Route::add('/dance', function () {
    $controller = new DanceEventController();
    $controller->renderEventPage();
}, 'GET');

Route::add('/dance/artist/([a-z-0-9-]*)', function ($artist) {
    require_once(__DIR__ . "/../views/pages/events/dance-artist.php");
});
<?php

require_once(__DIR__ . '/../controllers/HistoryStrollEventController.php');

Route::add('/strolls', function() {
    $controller = new HistoryStrollEventController();
    $controller->renderEventPage();
});

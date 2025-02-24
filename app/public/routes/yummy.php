<?php

require_once(__DIR__ . '/../controllers/YummyEventController.php');

Route::add('/yummy', function() {
    $controller = new YummyEventController();
    $controller->renderEventPage();
});
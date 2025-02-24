<?php

require_once __DIR__ . '/../controllers/TeylersEventController.php';

Route::add('/teylers', function() {
    $controller = new TeylersEventController();
    $controller->renderEventPage();
}, 'GET');

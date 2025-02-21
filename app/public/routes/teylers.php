<?php
require_once __DIR__ . '/../controllers/MagicTeylersEventController.php';

Route::add('/teylers', function () {
    $controller = new MagicTeylersEventController();
    $controller->showIndex();
}, 'GET');
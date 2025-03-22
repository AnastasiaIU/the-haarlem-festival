<?php

require_once(__DIR__ . '/../../src/controllers/ButtonController.php');

Route::add('/api/getButtonById/([0-9]+)', function ($buttonId) {
    $buttonController = new ButtonController();
    $button = $buttonController->fetchButtonById($buttonId);
    echo json_encode($button);
});

Route::add('/api/getTextByType/([a-zA-Z0-9_-]+)', function ($type) {
    $buttonController = new ButtonController();
    $text = $buttonController->fetchTextByType($type);
    echo json_encode(['type' => $type, 'text' => $text]);
});
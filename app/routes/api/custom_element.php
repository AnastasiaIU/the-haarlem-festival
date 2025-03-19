<?php

require_once(__DIR__ . '/../../src/controllers/CustomElementController.php');

Route::add('/api/getCustomByIdentifier/([a-zA-Z0-9_-]*)', function ($identifier) {
    $customController = new CustomElementController();
    $custom = $customController->fetchCustomByIdentifier($identifier);
    echo json_encode($custom);
});
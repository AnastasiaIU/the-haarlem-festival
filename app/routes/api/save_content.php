<?php

require_once(__DIR__ . '/../../src/controllers/ContentController.php');
require_once(__DIR__ . '/../../src/services/AuthHandler.php');

Route::add('/api/uploadContent', function () {
    AuthHandler::checkAdminLoggedIn();

    header('Content-Type: application/json');

    $table = $_POST['table'];
    $column = $_POST['column'];
    $id = $_POST['id'];
    $content = $_POST['content'] ?? null;
    $content = ($content === '') ? null : $content;

    if (!$table || !$column || !$id) {
        echo json_encode(["status" => "error", "message" => "Missing required fields"]);
        return;
    }

    try {
        $contentController = new ContentController();
        $contentController->updateContent($table, $column, $id, $content);

        echo json_encode(["status" => "success", "message" => "Content updated successfully!"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Failed to update content: " . $e->getMessage()]);
    }
}, 'post');
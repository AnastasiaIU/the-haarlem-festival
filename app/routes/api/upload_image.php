<?php

require_once(__DIR__ . '/../../src/controllers/ImageController.php');
require_once(__DIR__ . '/../../src/services/AuthHandler.php');

Route::add('/api/uploadImage', function () {
    AuthHandler::checkAdminLoggedIn();

    $table = $_POST['table'];
    $column = $_POST['column'];
    $id = $_POST['id'];

    $targetDir = __DIR__ . '/../../public/assets/images/';
    $fileName = uniqid() . "_" . basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        $imageController = new ImageController();
        $imageController->updateImage($table, $column, $id, $fileName);

        // Create correct URL path for frontend
        $imageUrl = "/assets/images/" . $fileName;
        echo json_encode(["status" => "success", "message" => "Image uploaded successfully", "imagePath" => $imageUrl]);
    } else {
        echo json_encode(["status" => "error", "message" => "Failed to upload"]);
    }
}, 'post');
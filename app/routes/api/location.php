<?php

require_once(__DIR__ . '/../../src/controllers/LocationController.php');

Route::add('/api/getLocations', function () {
    $locationController = new LocationController();
    $location = $locationController->fetchAllLocations();
    echo json_encode($location);
});

Route::add('/api/getLocationBySlug/([a-zA-Z0-9_-]*)', function ($locationSlug) {
    $locationController = new LocationController();
    $location = $locationController->fetchLocationBySlug($locationSlug);
    echo json_encode($location);
});

Route::add('/api/createLocation', function () {
    $locationController = new LocationController();
    $data = array_merge($_POST, $_FILES);

    if ($locationController->createLocation($data)) {
        echo json_encode(["success" => true, "message" => "Location created successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to create location."]);
    }
}, 'post');

Route::add('/api/updateLocation/([0-9]+)', function ($id) {
    $locationController = new LocationController();
    $data = array_merge($_POST, $_FILES);
    $uploadDir = __DIR__ . '/../../public/assets/images/'; 
    foreach ($_FILES as $key => $file) {
        if (isset($file['name']) && $file['name']) {
            $fileName = time() . '_' . basename($file['name']);
            $filePath = $uploadDir . $fileName;

            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                $data[$key] = $fileName; 
            } else {
                echo json_encode(["success" => false, "message" => "Error uploading file: $fileName"]);
                return;
            }
        }
    }
    if ($locationController->updateLocation($id, $data)) {
        echo json_encode(["success" => true, "message" => "Location updated successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update location."]);
    }
}, 'post');

Route::add('/api/deleteLocation/([0-9]+)', function ($id) {
    $locationController = new LocationController();

    if ($locationController->deleteLocation((int)$id)) {
        echo json_encode(["success" => true, "message" => "Location deleted successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete location."]);
    }
}, 'delete');
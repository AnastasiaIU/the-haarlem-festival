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
    $data = json_decode(file_get_contents("php://input"), true);

    if ($locationController->createLocation($data)) {
        echo json_encode(["success" => true, "message" => "Location created successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to create location."]);
    }
}, 'post');

Route::add('/api/updateLocation/([0-9]+)', function ($id) {
    $locationController = new LocationController();
    
    // Merge POST and FILES data
    $data = array_merge($_POST, $_FILES);

    // Handle file uploads
    $uploadDir = 'uploads/'; // Ensure this directory exists and is writable

    foreach ($_FILES as $key => $file) {
        if (isset($file['name']) && $file['name']) {
            // Generate a unique name for each uploaded file
            $fileName = time() . '_' . basename($file['name']);
            $filePath = $uploadDir . $fileName;

            // Move the uploaded file to the server
            if (move_uploaded_file($file['tmp_name'], $filePath)) {
                $data[$key] = $fileName;  // Store the file name/path in the data array
            } else {
                // Handle file upload error
                echo json_encode(["success" => false, "message" => "Error uploading file: $fileName"]);
                return;
            }
        }
    }

    // Update the location in the database
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
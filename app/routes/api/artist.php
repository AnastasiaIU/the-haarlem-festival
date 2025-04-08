<?php

require_once(__DIR__ . '/../../src/controllers/ArtistController.php');

Route::add('/api/getArtists', function () {
    $artistController = new ArtistController();
    $artists = $artistController->fetchAllArtists();
    echo json_encode($artists);
});

Route::add('/api/getArtistById/([0-9]+)', function ($artistId) {
    $artistController = new ArtistController();
    $artist = $artistController->fetchArtistById($artistId);
    echo json_encode($artist);
});

Route::add('/api/getArtistBySlug/([a-zA-Z0-9_-]*)', function ($artistSlug) {
    $artistController = new ArtistController();
    $artist = $artistController->fetchArtistBySlug($artistSlug);
    echo json_encode($artist);
});

Route::add('/api/updateArtist/([0-9]+)', function ($id) {
    $artistController = new ArtistController();
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

    if ($artistController->updateArtist($id, $data)) {
        echo json_encode(["success" => true, "message" => "Artist updated successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to update artist."]);
    }
}, 'post');

Route::add('/api/createArtist', function (){
    $artistController = new ArtistController();
    $data = array_merge($_POST, $_FILES);

    if($artistController->createArtist($data)){
        echo json_encode(["success" => true, "message" => "Artist create succesfully."]);
    } else{
        echo json_encode(["success" => false, "message" => "Failed to create artist."]);
    }
}, 'post');

Route::add('/api/deleteArtist/([0-9]+)', function ($id) {
    $artistController = new ArtistController();

    if ($artistController->deleteArtist((int)$id)) {
        echo json_encode(["success" => true, "message" => "Artist deleted successfully."]);
    } else {
        echo json_encode(["success" => false, "message" => "Failed to delete artist."]);
    }
}, 'delete');
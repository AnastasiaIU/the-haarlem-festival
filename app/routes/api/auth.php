<?php

Route::add('/api/authAdmin', function () {
    header('Content-Type: application/json; charset=utf-8');

    $isAdmin = AuthHandler::isAdmin();

    echo json_encode(["isAdmin" => $isAdmin]);
});

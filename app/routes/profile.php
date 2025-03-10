<?php

require_once(__DIR__ . '/../src/services/AuthHandler.php');

Route::add('/profile', function () {
    AuthHandler::checkUserLoggedIn();

    require_once(__DIR__ . "/../views/pages/profile.php");
});

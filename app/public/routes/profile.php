<?php

require_once(__DIR__ . '/../services/AuthHandler.php');

Route::add('/profile', function () {
    AuthHandler::checkUserLoggedIn();

    require_once(__DIR__ . "/../views/pages/profile.php");
});

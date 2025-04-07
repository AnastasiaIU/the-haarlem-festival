<?php

require_once(__DIR__ . '/../src/services/AuthHandler.php');

Route::add('/profile', function () {
    AuthHandler::checkUserLoggedIn();

    require_once(__DIR__ . "/../views/pages/profile.php");
});

Route::add('/profile/edit', function () {
    AuthHandler::checkUserLoggedIn();

    require_once(__DIR__ . "/../views/pages/profile_edit_info.php");
});

Route::add('/profile/personal-plan', function () {
    AuthHandler::checkUserLoggedIn();

    require_once(__DIR__ . "/../views/pages/profile_personal_plan.php");
});
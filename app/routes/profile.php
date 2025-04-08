<?php

require_once(__DIR__ . '/../src/services/AuthHandler.php');

Route::add('/profile', function () {
    AuthHandler::checkUserLoggedIn();

    require_once(__DIR__ . "/../views/pages/profile.php");
});


Route::add('/profile/personal-plan', function () {
    AuthHandler::checkUserLoggedIn();

    require_once(__DIR__ . "/../views/pages/profile_personal_plan.php");
});
Route::add('/profile/manage_events', function (){
    AuthHandler::checkAdminLoggedIn();

    require_once(__DIR__ . "/../views/pages/manage_events.php");
});

Route::add('/profile/change_account', function (){
    require_once(__DIR__."/../views/pages/change_account.php");
});

Route::add('/profile/manage_users', function (){
    AuthHandler::checkAdminLoggedIn();

    require_once(__DIR__."/../views/pages/manage_users.php");
});

Route::add('/profile/view_orders', function(){
    AuthHandler::checkAdminLoggedIn();
    require_once(__DIR__."/../views/pages/view_orders.php");
});
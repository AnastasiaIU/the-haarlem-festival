<?php

Route::add('/', function () {
    // Store the current URL in the session
    $_SESSION['last_visited_url'] = $_SERVER['REQUEST_URI'];
    
    require_once(__DIR__ . "/../views/pages/index.php");
});

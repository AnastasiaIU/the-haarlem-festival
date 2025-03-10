<?php

// Logout route
Route::add('/logout', function () {
    unset($_SESSION['user']);

    // Redirect to the last visited page or default to home page
    $redirectUrl = $_SESSION['last_visited_url'] ?? '/';
    header("Location: $redirectUrl");
});
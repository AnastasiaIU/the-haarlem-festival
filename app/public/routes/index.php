<?php
// main route file

Route::add('/', function () {
    require_once(__DIR__ . "/../views/pages/index.php");
});

// ...later include events.php and other route files...

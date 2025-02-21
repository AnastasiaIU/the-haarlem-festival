<?php
// main route file

Route::add('/', function () {
    require(__DIR__ . "/../views/pages/index.php");
});

// ...later include events.php and other route files...

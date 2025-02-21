<?php
// main route file
require_once __DIR__ . '/dance.php';
require_once __DIR__ . '/yummy.php';
require_once __DIR__ . '/strolls.php';
require_once __DIR__ . '/teylers.php';

Route::add('/', function () {
    require_once(__DIR__ . "/../views/pages/index.php");
});


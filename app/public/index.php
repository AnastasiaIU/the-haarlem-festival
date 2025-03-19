<?php

/**
 * Set env variables and enable error reporting in local environment.
 */
require_once(__DIR__ . "/../env.php");
require_once(__DIR__ . "/../lib/error_reporting.php");

/**
 * Enable the ErrorHandler class for using the error and exception handlers.
 */
require_once(__DIR__ . '/../src/services/ErrorHandler.php');
ErrorHandler::register();

/**
 * Start user session.
 */
session_start();

/**
 * Require routing library. Allows handling request for different URL routes, i.e. /dance, /yummy, etc.
 */
require_once(__DIR__ . "/../lib/Route.php");

/**
 * Require routes. Defines the routes that the application will need.
 */
require_once(__DIR__ . "/../routes/index.php");
require_once(__DIR__ . "/../routes/cart.php");
require_once(__DIR__ . "/../routes/dance.php");
require_once(__DIR__ . "/../routes/login.php");
require_once(__DIR__ . "/../routes/logout.php");
require_once(__DIR__ . "/../routes/profile.php");
require_once(__DIR__ . "/../routes/register.php");
require_once(__DIR__ . "/../routes/strolls.php");
require_once(__DIR__ . "/../routes/teylers.php");
require_once(__DIR__ . "/../routes/yummy.php");
require_once(__DIR__ . "/../routes/api/event.php");
require_once(__DIR__ . "/../routes/api/uploadImage.php");
require_once(__DIR__ . "/../routes/api/button.php");
require_once(__DIR__ . "/../routes/api/customElement.php");

// Start the router, enabling handling requests
Route::run();
<?php

/**
 * Set env variables and enable error reporting in local environment.
 */
require_once(__DIR__ . "/lib/env.php");
require_once(__DIR__ . "/lib/error_reporting.php");

/**
 * Enable the ErrorHandler class for using the error and exception handlers.
 */
require_once(__DIR__ . '/services/ErrorHandler.php');
ErrorHandler::register();

/**
 * Start user session.
 */
session_start();

/**
 * Require routing library. Allows handling request for different URL routes, i.e. /dance, /yummy, etc.
 */
require_once(__DIR__ . "/lib/Route.php");

/**
 * Require routes. Defines the routes that the application will need.
 */
require_once(__DIR__ . "/routes/index.php");

// Start the router, enabling handling requests
Route::run();

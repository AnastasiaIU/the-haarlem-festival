<?php

/**
 * Set env variables and enable error reporting in local environment
 */
require_once(__DIR__ . "/lib/env.php"); // sets global env variables (database configuration)
require_once(__DIR__ . "/lib/error_reporting.php"); // enables error reporting locally

/**
 * Enable the ErrorHandler class for using the error and exception handlers.
 */
require_once(__DIR__ . '/services/ErrorHandler.php');
ErrorHandler::register();

/**
 * Start user session
 */
session_start();

/**
 * Require routing library. Allows handling request for different URL routes, i.e. /users, /events, etc.
 */
require_once(__DIR__ . "/lib/Route.php");

/**
 * Require routes. Defines the routes that our application will need.
 */
require_once(__DIR__ . "/routes/index.php");
require_once(__DIR__ . "/routes/user.php");

// Start the router, enabling handling requests
Route::run();

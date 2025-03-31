<?php

require_once(__DIR__ . '/../../src/controllers/ScheduleController.php');

/**
 * API route to fetch all schedules.
 */
Route::add('/api/getSchedules', function () {
    $scheduleController = new ScheduleController();
    $schedules = $scheduleController->fetchAllSchedules();
    echo json_encode($schedules);
});


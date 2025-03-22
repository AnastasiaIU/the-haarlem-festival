<?php

require_once(__DIR__ . '/../../src/controllers/ScheduleController.php');


/**
 * API route to fetch all schedules.
 */
Route::add('/api/getSchedules', function () {
    $scheduleController = new ScheduleController();
    $schedules = $scheduleController->fetchAllSchedules();

    $schedulesArray = array_map(function($schedule) {
        return $schedule->toArray();
    }, $schedules);
    echo json_encode($schedulesArray);
});


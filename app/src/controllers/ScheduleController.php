<?php

require_once(__DIR__ . '/../models/ScheduleModel.php');

/**
 * Controller class for handling schedule-related operations.
 */
class ScheduleController
{
    private ScheduleModel $scheduleModel;

    public function __construct()
    {
        $this->scheduleModel = new ScheduleModel();
    }

    public function fetchAllSchedules(): array
    {
        return $this->scheduleModel->fetchAllSchedules();
    }
}
<?php

require_once(__DIR__ . "/BaseModel.php");
require_once(__DIR__ . '/../dto/ScheduleDTO.php');

/**
 * ScheduleModel class extends BaseModel to interact with the schedule table in the database.
 */
class ScheduleModel extends BaseModel
{
    /**
     * Fetches all schedule entries ordered by date and start time.
     *
     * @return ScheduleDTO[] An array of ScheduleDTO objects.
     */
    public function fetchAllSchedules(): array
    {
        $query = self::$pdo->prepare(
            'SELECT id, date, title, start_time, end_time, title_color
            FROM schedule'
        );

        $query->execute();
        $schedules = [];

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $schedules[] = ScheduleDTO::fromArray($row);
        }

        return $schedules;
    }

}
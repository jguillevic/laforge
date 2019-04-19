<?php

namespace DAL\Store\Schedule;

use \Framework\DAL\Database;
use \Model\Store\Schedule\Schedule;
use \Model\Store\Schedule\DaySchedule;
use \Model\Store\Schedule\ScheduleSection;

/**
 * @author JGuillevic
 */
class ScheduleDAL
{
	private $db;

	public function __construct($db = null)
	{
		if (isset($db))
			$this->db = $db;
		else
			$this->db = new Database();
	}

    public function LoadAll()
    {
        $query = "SELECT S.Id FROM Schedule AS S;";

        $rows = $this->db->Read($query);

        $schedules = array();
        $scheduleIds = array();

        foreach ($rows as $row)
        {
            $schedule = new Schedule();
            $schedule->SetId($row['Id']);

            $scheduleIds[$schedule->GetId()] = $schedule->GetId();

            $schedules[$schedule->GetId()] = $schedule;
        }

        // Chargement des DaySchedules.
        $dayScheduleDAL = new DayScheduleDAL($this->db);
        $daySchedules = $dayScheduleDAL->LoadByScheduleIds($scheduleIds);

        foreach ($schedules as $schedule)
            $schedule->SetDaySchedules($daySchedules[$schedule->GetId()]);

        return $schedules;
    }
}
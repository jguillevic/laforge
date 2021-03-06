<?php

namespace DAL\Store\Schedule;

use \Framework\DAL\Database;
use \Framework\DAL\DALHelper;
use \Model\Store\Schedule\Schedule;
use \Model\Store\Schedule\DaySchedule;
use \Model\Store\Schedule\ScheduleSection;
use \DAL\Store\Schedule\DayScheduleDAL;

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

    public function LoadByIds($ids)
    {
        $query = "SELECT S.Id FROM Schedule AS S WHERE ";
        $params = array();
        $query .= DALHelper::SetArrayParams($ids, "S", "Id", $params);
        $query .= ";";
        $rows = $this->db->Read($query, $params);

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

    public function Update($schedules)
    {
        $dayScheduleDAL = new DayScheduleDAL($this->db);

        $daySchedules = [];

        foreach ($schedules as $schedule)
        {
            foreach ($schedule->GetDaySchedules() as $daySchedule)
                $daySchedules[] = $daySchedule;
        }

        $dayScheduleDAL->Update($daySchedules);
    }
}
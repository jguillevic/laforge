<?php

namespace DAL\Store\Schedule;

use \Framework\DAL\Database;
use \Framework\DAL\DALHelper;
use \Model\Store\Schedule\DaySchedule;
use \DAL\Day\DayDAL;

/**
 * @author JGuillevic
 */
class DayScheduleDAL
{
    private $db;

	public function __construct($db = null)
	{
		if (isset($db))
			$this->db = $db;
		else
			$this->db = new Database();
    }

    public function LoadByScheduleIds($scheduleIds)
    {
        // Chargement des jours.
        $dayDAL = new DayDAL($this->db);
        $days = $dayDAL->LoadAll();

        $query = "SELECT DS.Id, DS.DayId, DS.ScheduleId FROM DaySchedule AS DS WHERE ";
        $params = array();
        $query .= DALHelper::SetArrayParams($scheduleIds, "DS", "ScheduleId", $params);
        $query .= ";";

		$rows = $this->db->Read($query, $params);

        $daySchedulesByScheduleIds = array();
        $dayScheduleIds = array();

        foreach ($rows as $row)
        {
            $daySchedule = new DaySchedule();
			$daySchedule->SetId($row['Id']);
            $daySchedule->SetDay($days[$row['DayId']]);
            $scheduleId = $row['ScheduleId'];
            $dayScheduleIds[$daySchedule->GetId()] = $daySchedule->GetId();

            if (!array_key_exists($scheduleId, $daySchedulesByScheduleIds))
            $daySchedulesByScheduleIds[$scheduleId] = array();

			$daySchedulesByScheduleIds[$scheduleId][$daySchedule->GetId()] = $daySchedule;
        }

        // Chargement des DayScheduleSections.
        $dayScheduleSectionDAL = new DayScheduleSectionDAL($this->db);
        $dayScheduleSections = $dayScheduleSectionDAL->LoadByDayScheduleIds($dayScheduleIds);

        foreach ($daySchedulesByScheduleIds as $daySchedules)
        {
            foreach ($daySchedules as $daySchedule)
            {
                if (array_key_exists($daySchedule->GetId(), $dayScheduleSections))
                {
                    $sections = $dayScheduleSections[$daySchedule->GetId()];
                    $daySchedule->SetSections($sections);
                }
            }
        }

        return $daySchedulesByScheduleIds;
    }
}
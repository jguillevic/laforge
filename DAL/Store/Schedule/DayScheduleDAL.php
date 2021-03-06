<?php

namespace DAL\Store\Schedule;

use \Framework\DAL\Database;
use \Framework\DAL\DALHelper;
use \Model\Store\Schedule\DaySchedule;
use \DAL\Store\Schedule\DayScheduleSectionDAL;
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

        $query = "SELECT DS.Id, DS.ScheduleId, DS.DayId FROM DaySchedule AS DS WHERE ";
        $params = array();
        $query .= DALHelper::SetArrayParams($scheduleIds, "DS", "ScheduleId", $params);
        $query .= ";";

		$rows = $this->db->Read($query, $params);

        $daySchedulesByScheduleIds = array();
        $dayScheduleIds = array();

        foreach ($rows as $row)
        {
            $daySchedule = new DaySchedule();
            $daySchedule->SetId($row["Id"]);
            $daySchedule->SetScheduleId($row["ScheduleId"]);
            $daySchedule->SetDay($days[$row["DayId"]]);
            $scheduleId = $row["ScheduleId"];
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

    public function Update($daySchedules)
    {
        $dayScheduleIds = [];
        $dayScheduleSections = [];

        foreach ($daySchedules as $daySchedule)
        {
            $dayScheduleIds[] = $daySchedule->GetId();

            foreach ($daySchedule->GetSections() as $section)
                $dayScheduleSections[] = $section;
        }

        $dayScheduleSectionDAL = new DayScheduleSectionDAL($this->db);

        if (count($dayScheduleIds) > 0)
            $dayScheduleSectionDAL->DeleteFromDayScheduleIds($dayScheduleIds);
        if (count($dayScheduleSections) > 0)
            $dayScheduleSectionDAL->Add($dayScheduleSections);
    }
}
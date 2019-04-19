<?php

namespace DAL\Store\Schedule;

use \Framework\DAL\Database;
use \Framework\DAL\DALHelper;
use \Model\Store\Schedule\DayScheduleSection;

/**
 * @author JGuillevic
 */
class DayScheduleSectionDAL
{
    private $db;

	public function __construct($db = null)
	{
		if (isset($db))
			$this->db = $db;
		else
			$this->db = new Database();
    }

    public function LoadByDayScheduleIds($dayScheduleIds)
    {
        $query = "SELECT DSS.Id, DSS.DayScheduleId, DSS.StartingTime, DSS.EndingTime FROM DayScheduleSection AS DSS WHERE ";
        $params = array();
        $query .= DALHelper::SetArrayParams($dayScheduleIds, "DSS", "DayScheduleId", $params);
        $query .= ";";

		$rows = $this->db->Read($query, $params);

        $dayScheduleSections = array();

        foreach ($rows as $row)
        {
            $dayScheduleSection = new DayScheduleSection();
			$dayScheduleSection->SetId($row['Id']);
			$dayScheduleSection->SetStartingTime(new \DateTime($row['StartingTime']));
			$dayScheduleSection->SetEndingTime(new \DateTime($row['EndingTime']));

            $dayScheduleId = $row['DayScheduleId'];

            if (!array_key_exists($dayScheduleId, $dayScheduleSections))
                $dayScheduleSections[$dayScheduleId] = array();

			$dayScheduleSections[$dayScheduleId][$dayScheduleSection->GetId()] = $dayScheduleSection;
        }

        return $dayScheduleSections;
    }
}
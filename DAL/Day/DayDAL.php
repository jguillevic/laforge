<?php

namespace DAL\Day;

use \Model\Day\Day;

/**
 * @author JGuillevic
 */
class DayDAL
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
        $query = "SELECT D.Id, D.Code FROM Day AS D;";

        $rows = $this->db->Read($query);

        $days = array();

        foreach ($rows as $row)
        {
            $day = new Day();
            $day->SetId($row['Id']);
            $day->SetCode($row['Code']);

            $days[$day->GetId()] = $day;
        }

        return $days;
    }
}
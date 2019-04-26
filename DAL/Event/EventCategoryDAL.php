<?php

namespace DAL\Event;

use \Framework\DAL\Database;
use \Framework\DAL\DALHelper;
use \Model\Event\EventCategory;

/**
 * @author JGuillevic
 */
class EventCategoryDAL
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
        $query = "SELECT EC.Id, EC.Name FROM EventCategory AS EC WHERE ";
        $params = [];
        $query .= DALHelper::SetArrayParams($ids, "EC", "Id", $params);
        $query .= ";";
        $rows = $this->db->Read($query, $params);

        $eventCategories = [];

        foreach ($rows as $row)
        {
            $eventCategory = new EventCategory();

            $eventCategory->SetId($row["Id"]);
            $eventCategory->SetName($row["Name"]);

            $eventCategories[$eventCategory->GetId()] = $eventCategory;
        }

        return $eventCategories;
    }
}
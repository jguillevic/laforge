<?php

namespace DAL\History;

use \Framework\DAL\Database;
use \Framework\DAL\DALHelper;
use \Model\History\Change;
use \DAL\User\DisplayedUserDAL;

/**
 * @author JGuillevic
 */
class ChangeDAL
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
        $query = "SELECT C.Id, C.DateTime, C.UserId FROM Change AS C WHERE ";
        $params = [];
        $query .= DALHelper::SetArrayParams($ids, "C", "Id", $params);
        $query .= "ORDER BY C.DateTime ASC;";
        $rows = $this->db->Read($query, $params);

        $changes = [];
        $userIds = [];

        foreach ($rows as $row)
        {
            $change = new Change();

            $id = $row["Id"];

            $change->SetId($id);
            $change->SetDateTime($row["DateTime"]);
            
            $userIds[$id] = $row["UserId"];

            $changes[$id] = $change;
        }

        $displayedUserDAL = new DisplayedUserDAL($this->db);
        $displayedUsers = $displayedUserDAL->LoadByIds($userIds);

        foreach ($changes as $change)
            $change->SetDisplayedUser($displayedUsers[$change->GetId()]);

        return $changes;
    }
}
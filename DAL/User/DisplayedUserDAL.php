<?php

namespace DAL\User;

use \Framework\DAL\Database;
use \Framework\DAL\DALHelper;
use \Model\User\DisplayedUser;

/**
 * @author JGuillevic
 */
class DisplayedUserDAL
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
        $query = "SELECT U.Id, U.Username FROM User AS U WHERE ";
        $params = [];
        $query .= DALHelper::SetArrayParams($ids, "U", "Id", $params);
        $query .= ";";
        $rows = $this->db->Read($query, $params);

        $displayedUsers = [];

        foreach ($rows as $row)
        {
            $displayedUser = new DisplayedUser();

            $displayedUser->SetId($row["Id"]);
            $displayedUser->SetUsername($row["Username"]);

            $displayedUsers[$displayedUser->GetId()] = $displayedUser;
        }

        return $displayedUsers; 
    }
}
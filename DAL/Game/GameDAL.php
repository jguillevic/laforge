<?php

namespace DAL\Game;

use \Framework\DAL\Database;
use \Framework\DAL\DALHelper;
use \Model\Game\Game;

/**
 * @author JGuillevic
 */
class GameDAL
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
        $query = "SELECT G.Id, G.Name FROM Game AS G WHERE ";
        $params = [];
        $query .= DALHelper::SetArrayParams($ids, "G", "Id", $params);
        $query .= ";";
        $rows = $this->db->Read($query, $params);

        $games = [];

        foreach ($rows as $row)
        {
            $game = new Game();

            $game->SetId($row["Id"]);
            $game->SetName($row["Name"]);

            $games[$game->GetId()] = $game;
        }

        return $games;
    }
}
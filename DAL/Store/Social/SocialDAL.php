<?php

namespace DAL\Store\Social;

use \Framework\DAL\Database;
use \Model\Store\Social\Social;

/**
 * @author JGuillevic
 */
class SocialDAL
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
        $query = "SELECT S.Id, S.FacebookLink, S.TwitterLink, S.YoutubeLink, S.InstagramLink FROM Social AS S WHERE ";
        $params = array();
        $query .= DALHelper::SetArrayParams($ids, "S", "Id", $params);
        $query .= ";";
        $rows = $this->db->Read($query, $params);

        $socials = array();

        foreach ($rows as $row)
        {
            $social = new Social();
            $social->SetId($row['Id']);
            $social->SetFacebookLink($row['FacebookLink']);
            $social->SetTwitterLink($row['TwitterLink']);
            $social->SetYoutubeLink($row['YoutubeLink']);
            $social->SetInstagramLink($row['InstagramLink']);            

            $socials[$social->GetId()] = $social;
        }

        return $socials;
    }
}
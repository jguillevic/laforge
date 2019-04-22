<?php

namespace DAL\Store\Social;

use \Framework\DAL\Database;
use \Framework\DAL\DALHelper;
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

    public function Update($socials)
    {
        $query = "UPDATE Social
                SET FacebookLink = :FacebookLink
                , TwitterLink = :TwitterLink
                , YoutubeLink = :YoutubeLink
                , InstagramLink = :InstagramLink
                WHERE Id = :Id;"

        foreach ($socials as $social)
        {
            $params = [
                'Id' => $social->GetId()
                , 'FacebookLink' => $social->GetFacebookLink()
                , 'TwitterLink' => $social->GetTwitterLink()
                , 'YoutubeLink' => $social->GetYoutubeLink()
                , 'InstagramLink' => $social->GetInstagramLink()
            ];

            $this->db->Execute($query, $params);
        }
    }
}
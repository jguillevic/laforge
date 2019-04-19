<?php

namespace DAL\Store\Address;

use \Framework\DAL\Database;
use \Model\Store\Address\Address;

/**
 * @author JGuillevic
 */
class AddressDAL
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
        $query = "SELECT A.Id, A.SocialReason, A.Line1, A.Line2, A.Line3, A.PostalCode, A.City FROM Address AS A WHERE ";
        $params = array();
        $query .= DALHelper::SetArrayParams($ids, "A", "Id", $params);
        $query .= ";";
        $rows = $this->db->Read($query, $params);

        $addresses = array();

        foreach ($rows as $row)
        {
            $address = new Address();
            $address->SetId($row['Id']);
            $address->SetSocialReason($row['SocialReason']);
            $address->SetLine1($row['Line1']);
            $address->SetLine2($row['Line2']);
            $address->SetLine3($row['Line3']);
            $address->SetPostalCode($row['PostalCode']);
            $address->SetCity($row['City']);

            $addresses[$address->GetId()] = $address;
        }

        return $addresses;
    }
}
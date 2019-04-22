<?php

namespace DAL\Store\Contact;

use \Framework\DAL\Database;
use \Framework\DAL\DALHelper;
use \Model\Store\Contact\Contact;

/**
 * @author JGuillevic
 */
class ContactDAL
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
        $query = "SELECT C.Id, C.Email, C.Messenger, C.PhoneNumber FROM Contact AS C WHERE ";
        $params = array();
        $query .= DALHelper::SetArrayParams($ids, "C", "Id", $params);
        $query .= ";";
        $rows = $this->db->Read($query, $params);

        $contacts = array();

        foreach ($rows as $row)
        {
            $contact = new Contact();
            $contact->SetId($row['Id']);
            $contact->SetEmail($row['Email']);
            $contact->SetMessenger($row['Messenger']);
            $contact->SetPhoneNumber($row['PhoneNumber']);

            $contacts[$contact->GetId()] = $contact;
        }

        return $contacts;
    }

    public function Update($contacts)
    {
        $query = "UPDATE contact
            Email = :Email
            , Messenger = :Messenger
            , PhoneNumber = :PhoneNumber
            WHERE Id = :Id;";

        foreach ($contacts as $contact)
        {
            $params = [
                'Id' => $contact->GetId()
                , 'Email' => $contact->GetEmail()
                , 'Messenger' => $contact->GetMessenger()
                , 'PhoneNumber' => $contact->GetPhoneNumber()
            ];

            $this->db->Execute($query, $params);
        }
    }
}
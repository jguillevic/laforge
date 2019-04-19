<?php

namespace DAL\Store;

use \Framework\DAL\Database;
use \Model\Store\Store;
use \DAL\Address\AddressDAL;
use \DAL\Contact\ContactDAL;
use \DAL\Schedule\ScheduleDAL;
use \DAL\Social\SocialDAL;

/**
 * @author JGuillevic
 */
class StoreDAL
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
        $query = 'SELECT S.Id, S.AddressId, S.ContactId, S.SocialId, S.ScheduleId FROM Social AS S;';

        $rows = $this->db->Read($query);

        $stores = array();
        $addressIds = array();
        $contactIds = array();
        $socialIds = array();
        $scheduleIds = array();

        foreach ($rows as $row)
        {
            $store = new Store();
            $store->SetId($row['Id']);

            $addressIds[$store->GetId()] = $row['AddressId'];
            $contactIds[$store->GetId()] = $row['ContactId'];
            $socialIds[$store->GetId()] = $row['SocialId'];
            $scheduleIds[$store->GetId()] = $row['ScheduleId'];

            $stores[$store->GetId()] = $store;
        }

        // Chargement des adresses.
        $addressDAL = new AddressDAL();
        $addresses = $addressDAL->LoadByIds($addressIds);

        // Chargement des contacts.
        $contactDAL = new ContactDAL();
        $contacts = $contactDAL->LoadByIds($contactIds);

        // Chargement des infos sociales.
        $socialDAL = new SocialDAL();
        $socials = $socialDAL->LoadByIds($socialIds);

        // Chargements horaires.
        $scheduleDAL = new ScheduleDAL();
        $schedules = $scheduleDAL->LoadByIds($scheduleIds);

        

        return $stores;
    }
}
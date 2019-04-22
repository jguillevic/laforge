<?php

namespace DAL\Store;

use \Framework\DAL\Database;
use \Framework\DAL\DALHelper;
use \Model\Store\Store;
use \DAL\Store\Address\AddressDAL;
use \DAL\Store\Contact\ContactDAL;
use \DAL\Store\Schedule\ScheduleDAL;
use \DAL\Store\Social\SocialDAL;

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
        $query = 'SELECT S.Id, S.AddressId, S.ContactId, S.SocialId, S.ScheduleId FROM Store AS S;';

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
        $addressDAL = new AddressDAL($this->db);
        $addresses = $addressDAL->LoadByIds($addressIds);

        // Chargement des contacts.
        $contactDAL = new ContactDAL($this->db);
        $contacts = $contactDAL->LoadByIds($contactIds);

        // Chargement des infos sociales.
        $socialDAL = new SocialDAL($this->db);
        $socials = $socialDAL->LoadByIds($socialIds);

        // Chargements horaires.
        $scheduleDAL = new ScheduleDAL($this->db);
        $schedules = $scheduleDAL->LoadByIds($scheduleIds);

        foreach ($stores as $store)
        {
            $store->SetAddress($addresses[$addressIds[$store->GetId()]]);
            $store->SetContact($contacts[$contactIds[$store->GetId()]]);
            $store->SetSocial($socials[$socialIds[$store->GetId()]]);
            $store->SetSchedule($schedules[$scheduleIds[$store->GetId()]]);
        }

        return $stores;
    }

    public function Update($stores)
    {
        $addresses = [];
        $contacts = [];
        $socials = [];
        $schedules = [];

        foreach ($stores as $store)
        {
            $addresses[$store->GetAddress()->GetId()] = $store->GetAddress();
            $contacts[$store->GetContat()->GetId()] = $store->GetContact();
            $socials[$store->GetSocial()->GetId()] = $store->GetSocial();
            $schedules[$store->GetSchedule()->GetId()] = $store->GetSchedule();
        }

        $addressDAL = new AddressDAL($this->db);
        $addressDAL->Update($addresses);

        $contactDAL = new ContactDAL($this->db);
        $contactDAL->Update($contacts);

        $socialDAL = new SocialDAL($this->db);
        $socialDAL->Update($socials);

        $scheduleDAL = new ScheduleDAL($this->db);
        $scheduleDAL->Update($schedules);
    }
}
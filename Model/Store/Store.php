<?php

namespace Model\Store;

use \Model\Store\Address\Address;
use \Model\Store\Social\Social;
use \Model\Store\Contact\Contact;
use \Model\Store\Schedule\Schedule;

class Store
{
    private $id;
    private $address;
    private $social;
    private $contact;
    private $schedule;

    public function __construct()
    {
        $address = new Address();
        $social = new Social();
        $contact = new Contact();
        $schedule = new Schedule();
    }

    public function GetId()
    {
        return $this->id;
    }

    public function SetId($id)
    {
        $this->id = $id;
    }

    public function GetAddress()
    {
        return $this->address;
    }

    public function SetAddress($address)
    {
        $this->address = $address;
    }

    public function GetSocial()
    {
        return $this->social;
    }

    public function SetSocial($social)
    {
        $this->social = $social;
    }

    public function GetContact()
    {
        return $this->contact;
    }

    public function SetContact($contact)
    {
        $this->contact = $contact;
    }

    public function GetSchedule()
    {
        return $this->schedule;
    }

    public function SetSchedule($schedule)
    {
        $this->schedule = $schedule;
    }
}
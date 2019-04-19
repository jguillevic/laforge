<?php

namespace Model\Store\Address;

/**
 * @author JGuillevic
 */
class Address
{
    private $id;
    private $socialReason;
    private $line1;
    private $line2;
    private $postalCode;
    private $city;

    public function GetId()
    {
        return $this->id;
    }

    public function SetId($id)
    {
        $this->id = $id;
    }

    public function GetSocialReason()
    {
        return $this->socialReason;
    }

    
}
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
    private $line3;
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

    public function SetSocialReason($socialReason)
    {
        $this->socialReason = $socialReason;
    }

    public function GetLine1()
    {
        return $this->line1;
    }

    public function SetLine1($line1)
    {
        $this->line1 = $line1;
    }

    public function GetLine2()
    {
        return $this->line2;
    }

    public function SetLine2($line2)
    {
        $this->line2 = $line2;
    }

    public function GetLine3()
    {
        return $this->line3;
    }

    public function SetLine3($line3)
    {
        $this->line3 = $line3;
    }

    public function GetPostalCode()
    {
        return $this->postalCode;
    }

    public function SetPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    public function GetCity()
    {
        return $this->city;
    }

    public function SetCity($city)
    {
        $this->city = $city;
    }
}
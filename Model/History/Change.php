<?php

namespace Model\History;

use \Model\User\DisplayedUser;

/**
 * @author JGuillevic
 */
class Change
{
    private $id;
    private $dateTime;
    private $displayedUser;

    public function __construct()
    {
        $this->displayedUser = new DisplayedUser();
    }

    public function GetId()
    {
        return $this->id;
    }

    public function SetId($id)
    {
        $this->id = $id;
    }

    public function GetDateTime()
    {
        return $this->dateTime;
    }

    public function SetDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
    }

    public function GetDisplayedUser()
    {
        return $this->displayedUser;
    }

    public function SetDisplayedUser($displayedUser)
    {
        $this->displayedUser = $displayedUser;
    }
}
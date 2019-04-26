<?php

namespace Model\User;

/**
 * @author JGuillevic
 */
class DisplayedUser
{
    private $id;
    private $username;

    public function GetId()
    {
        return $this->id;
    }

    public function SetId($id)
    {
        $this->id = $id;
    }

    public function GetUsername()
    {
        return $this->username;
    }

    public function SetUsername($username)
    {
        $this->username = $username;
    }
}
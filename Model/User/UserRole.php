<?php

namespace Model\User;

/**
 * @author JGuillevic
 */
class UserRole
{
    private $id;
    private $code;

    public function GetId()
    {
        return $this->id;
    }

    public function SetId($id)
    {
        $this->id = $id;
    }

    public function GetCode()
    {
        return $this->code;
    }

    public function SetCode($code)
    {
        $this->code = $code;
    }
}
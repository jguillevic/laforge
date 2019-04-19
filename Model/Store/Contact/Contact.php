<?php

namespace Model\Store\Contact;

/**
 * @author JGuillevic
 */
class Contact
{
    private $id;
    private $email;
    private $messenger;
    private $phoneNumber;

    public function GetId()
    {
        return $this->id;
    }
    
    public function SetId($id)
    {
        $this->id = $id;
    }

    public function GetEmail()
    {
        return $this->email;
    }

    public function SetEmail($email)
    {
        $this->email = $email
    }

    public function GetMessenger()
    {
        return $this->messenger;
    }

    public function SetMessenger($messenger)
    {
        $this->messenger = $messenger;
    }

    public function GetPhoneNumber()
    {
        return $this->phoneNumber;
    }

    public function GetPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
}
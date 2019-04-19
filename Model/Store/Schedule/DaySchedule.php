<?php

namespace Model\Store\Schedule;

/**
 * @author JGuillevic
 */
class DaySchedule
{
    private $id;
    private $day;
    private $sections;

    public function __construct()
    {
        $this->sections = array();
    }

    public function GetId()
    {
        return $this->id;
    }

    public function SetId($id)
    {
        $this->id = $id;
    }

    public function GetDay()
    {
        return $this->day;
    }

    public function SetDay($day)
    {
        $this->day = $day;
    }

    public function GetSections()
    {
        return $this->sections;
    }

    public function SetSections($sections)
    {
        $this->sections = $sections;
    }

    public function IsOpen()
    {
        return count($this->sections) > 0;
    }
}
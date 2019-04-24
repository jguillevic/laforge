<?php

namespace Model\Store\Schedule;

use \Model\Day\Day;

/**
 * @author JGuillevic
 */
class DaySchedule
{
    private $id;
    private $scheduleId;
    private $day;
    private $sections;

    public function __construct()
    {
        $this->day = new Day();
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

    public function GetScheduleId()
    {
        return $this->scheduleId;
    }

    public function SetScheduleId($scheduleId)
    {
        $this->scheduleId = $scheduleId;
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

    public function AddSection($key, $value)
    {
        $this->sections[$key] = $value;
    }

    public function IsOpen()
    {
        return count($this->sections) > 0;
    }
}
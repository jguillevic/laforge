<?php

namespace Model\Store\Schedule;

/**
 * @author JGuillevic
 */
class Schedule
{
    private $id;
    private $daySchedules;

    public function __construct()
    {
        $this->scheduleDays = array();
    }

    public function GetId()
    {
        return $this->id;
    }

    public function SetId($id)
    {
        $this->id = $id;
    }

    public function GetDaySchedules()
    {
        return $this->daySchedules;
    }

    public function SetDaySchedules($daySchedules)
    {
        $this->daySchedules = $daySchedules;
    }
}
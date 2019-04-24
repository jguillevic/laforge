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
        $this->daySchedules = [];
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

    public function AddDaySchedule($key, $value)
    {
        $this->daySchedules[$key] = $value;
    }
}
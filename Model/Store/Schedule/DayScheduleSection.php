<?php

namespace Model\Store\Schedule;

/**
 * @author JGuillevic
 */
class DayScheduleSection
{
    private $id;
    private $startingTime;
    private $endingTime;

    public function GetId()
    {
        return $this->id;
    }

    public function SetId($id)
    {
        $this->id = $id;
    }

    public function GetStartingTime()
    {
        return $this->startingTime;
    }

    public function SetStartingTime($startingTime)
    {
        $this->startingTime = $startingTime;
    }

    public function GetEndingTime()
    {
        return $this->endingTime;
    }

    public function SetEndingTime($endingTime)
    {
        $this->endingTime = $endingTime;
    }
}
<?php

namespace BLL\Store\Schedule;

use \DAL\Store\Schedule\ScheduleDAL;

/**
 * @author JGuillevic
 */
class ScheduleBLL
{
	private $scheduleDAL;

	public function __construct()
	{
		$this->scheduleDAL = new ScheduleDAL();
    }
    
    public function LoadAll()
    {
        return $this->scheduleDAL->LoadAll();
    }
}
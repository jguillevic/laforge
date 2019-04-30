<?php

namespace BLL\Game;

use \DAL\Game\GameDAL;

/**
 * @author JGuillevic
 */
class GameBLL
{
	private $gameDAL;

	public function __construct()
	{
		$this->gameDAL = new GameDAL();
    }
    
    public function LoadAll()
	{
		return $this->gameDAL->LoadAll();
	}
}
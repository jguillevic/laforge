<?php

namespace Controller\Game;

use \Framework\View\View;
use \Tools\Helper\UserHelper;
use \Framework\Tools\Helper\PathHelper;
use \Framework\Tools\Helper\RoutesHelper;
use \BLL\Game\GameBLL;

/**
 * @author JGuillevic
 */
class GameController
{
    public function Manage($queryParameters)
    {
        if (UserHelper::CanManageGame())
		{
			$gameBLL = new GameBLL();
			$games = $gameBLL->LoadAll();

			$path = PathHelper::GetPath([ "Game", "ManageGame" ]);
			$view = new View($path);
			return $view->Render(["games" => $games]);
		}

		RoutesHelper::Redirect("DisplayHome");
    }

    public function Add($queryParameters)
    {

    }

    public function Update($queryParameters)
    {

    }

    public function Delete($queryParameters)
    {

    }
}
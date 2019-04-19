<?php

namespace Controller\About;

use \Framework\View\View;
use \Framework\Tools\Helper\PathHelper;
use \BLL\Store\Schedule\ScheduleBLL;

class AboutController
{
	public function Display($queryParameters)
	{
		// Chargement des horaires.
		$scheduleBLL = new ScheduleBLL();
		// Récupération d'une valeur qui est la seule.
		$schedules = $scheduleBLL->LoadAll();
		$schedule = array_pop($schedules);

		$path = PathHelper::GetPath([ "About", "DisplayAbout" ]);
		$view = new View($path);

		return $view->Render([ "schedule" => $schedule ]);
	}
}
<?php

namespace Controller\About;

use \Framework\View\View;
use \Framework\Tools\Helper\PathHelper;
use \BLL\Store\StoreBLL;

class AboutController
{
	public function Display($queryParameters)
	{
		// Chargement des infos du magasin.
		$storeBLL = new ScheduleBLL();
		$stores = $storeBLL->LoadAll();
		// Récupération d'une valeur qui est la seule.
		$store = array_pop($stores);

		$path = PathHelper::GetPath([ "About", "DisplayAbout" ]);
		$view = new View($path);

		return $view->Render([ "store" => $store ]);
	}
}
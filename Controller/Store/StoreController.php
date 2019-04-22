<?php

namespace Controller\Store;

use \Framework\View\View;
use \Tools\Helper\UserHelper;
use \Model\Store\Store;
use \BLL\Store\StoreBLL;
use \Framework\Tools\Helper\PathHelper;
use \Framework\Tools\Helper\RoutesHelper;

/**
 * @author JGuillevic
 */
class StoreController
{
    public function Update($queryParameters)
    {
        if (UserHelper::CanManageStore())
		{
            $storeBLL = new StoreBLL();

            if ($_SERVER['REQUEST_METHOD'] === 'GET')
			{
                $storeBLL = new StoreBLL();
                $stores = $storeBLL->LoadAll();
                $store = array_pop($stores);

                $path = PathHelper::GetPath([ "Store", "ManageStore" ]);
                $view = new View($path);

                return $view->Render(["store" => $store]);
            }
            else if ($_SERVER['REQUEST_METHOD'] === 'POST') 
            {
                $store = new Store();

                self::MapStore($store, $queryParameters);

                
            }
        }

        RoutesHelper::Redirect("DisplayHome");
    }

    private static function MapStore($store, $queryParameters)
    {

    }
}
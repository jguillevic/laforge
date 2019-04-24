<?php

namespace BLL\Store;

use \DAL\Store\StoreDAL;

/**
 * @author JGuillevic
 */
class StoreBLL
{
    private $storeDAL;

	public function __construct()
	{
		$this->storeDAL = new StoreDAL();
    }

    public function LoadAll()
    {
        return $this->storeDAL->LoadAll();
    }

    public function Update($stores)
    {
        $this->storeDAL->Update($stores);
    }
}
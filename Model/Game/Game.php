<?php

namespace Model\Game;

/**
 * @author JGuillevic
 */
class Game
{
    private $id;
    private $name;

    public function GetId()
    {
        return $this->id;
    }

    public function SetId($id)
    {
        $this->id = $id;
    }

    public function GetName()
    {
        return $this->name;
    }

    public function SetName($name)
    {
        $this->name = $name;
    }
}
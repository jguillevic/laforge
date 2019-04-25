<?php

namespace Model\Event;

use \Model\Game\Game;
use \Model\Event\EventCategory;
use \Model\History\Creation;

/**
 * @author JGuillevic
 */
class Event
{
    private $id;
    private $name;
    private $description;
    private $game;
    private $eventCategory;
    private $date;
    private $startingTime;
    private $endingTime;
    private $creation;
    private $changes;

    public function __construct()
    {
        $this->game = new Game();
        $this->eventCategory = new EventCategory();
        $this->creation = new Creation();
        $this->changes = [];
    }

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

    public function GetDescription()
    {
        return $this->description;
    }

    public function SetDescription($description)
    {
        $this->description = $description;
    }

    public function GetGame()
    {
        return $this->game;
    }

    public function SetGame($game)
    {
        $this->game = $game;
    }

    public function GetEventCategory()
    {
        return $this->eventCategory;
    }

    public function SetEventCategory($eventCategory)
    {
        $this->eventCategory = $eventCategory;
    }

    public function GetDate()
    {
        return $this->date;
    }

    public function SetDate($date)
    {
        $this->date = $date;
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

    public function GetCreation()
    {
        return $this->creation;
    }

    public function SetCreation($creation)
    {
        $this->creation = $creation;
    }

    public function GetChanges()
    {
        return $this->cahnges;
    }

    public function SetChanges($changes)
    {
        $this->changes = $changes;
    }
}
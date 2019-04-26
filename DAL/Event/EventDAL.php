<?php

namespace DAL\Event;

use \Framework\DAL\Database;
use \Framework\DAL\DALHelper;
use \Model\Event\Event;
use \DAL\History\ChangeDAL;
use \DAL\Game\GameDAL;
use \DAL\Event\EventCategoryDAL;

/**
 * @author JGuillevic
 */
class EventDAL
{
    private $db;

	public function __construct($db = null)
	{
		if (isset($db))
			$this->db = $db;
		else
			$this->db = new Database();
    }

    public function LoadByIds($ids)
    {
        $query = "SELECT E.Id, E.Name, E.Description, E.GameId, E.EventCategoryId, E.Date, E.StartingTime, E.EndingTime FROM Event AS E WHERE ";
        $params = [];
        $query .= DALHelper::SetArrayParams($ids, "E", "Id", $params);
        $query .= ";";
        $rows = $this->db->Read($query, $params);

        $events = [];
        $eventIds = [];
        $gameIds = [];
        $eventCategoryIds = [];

        foreach ($rows as $row)
        {
            $event = new Event();

            $id = $row["Id"];

            $event->SetId($id);
            $event->SetName($row["Name"]);
            $event->SetDescription($row["Description"]);
            $event->SetDate(new \DateTime($row["Date"]));
            $event->SetStartingTime(new \DateTime($row["StartingTime"]));
            $event->SetEndingTime(new \DateTime($row["EndingTime"]));
            
            $eventIds[$id] = $id;
            $gameIds[$id] = $row["GameId"];
            $eventCategoryIds[$id] = $row["EventCategoryId"];

            $events[$event->GetId()] = $event;
        }

        $gameDAL = new GameDAL($this->db);
        $games = $gameDAL->LoadFromIds($gameIds);

        $eventCategoryDAL = new EventCategoryDAL($this->db);
        $eventCategories = $eventCategoryDAL->LoadFromIds($eventCategoryIds);

        $changes = $this->LoadChangesByEventIds($eventIds);

        foreach ($events as $event)
        {
            $eventId = $event->GetId();

            $event->SetGame($gameIds[$eventId]);
            $event->SetEventCategory($eventCategoryIds[$eventId]);
            $event->SetChanges($changes[$eventId]);
        }

        return $events;
    }

    private function LoadChangesByEventIds($eventIds)
    {
        $query = "SELECT E_C.EventId, E_C.ChangeId FROM Event_Change AS E_C WHERE ";
        $params = [];
        $query .= DALHelper::SetArrayParams($eventIds, "E_C", "EventId", $params);
        $query .= ";";
        $rows = $this->db->Read($query, $params);

        $changeIds = [];
        $eventChangeIds = [];

        foreach ($rows as $row)
        {
            $eventId = $row("EventId");
            $changeId = $row("ChangeId");

            $changeIds[] = $changeId;
            $eventChangeIds[$changeId] = $eventId;
        }

        $changeDAL = new ChangeDAL($this->db);
        $loadedChanges = $changeDAL->LoadByIds($changeIds);

        $changes = [];

        foreach ($loadedChanges as $changeId => $loadChange)
        {
            $eventId = $eventChangeIds[$changeId];

            if (!array_key_exists($eventId, $changes))
                $changes[$eventId] = [];

            $changes[$eventId][$changeId] = $loadChange;
        }

        return $changes;
    }
}
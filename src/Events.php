<?php

namespace Marcosh\Eventgraph;

use PhpOrient\Protocols\Binary\Data\Record;
use PhpOrient\Protocols\Binary\Data\ID;

class Events
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    /**
     * @param string
     * @param mixed Tag or array of Tags
     * @return event
     */
    public function createEvent($name, $tags)
    {
        $event = new Event();
        $event->setName($name)->setTs(date("Y-m-d H:i:s"));

        if (is_array($tags)) {
            $tagsIds = array_map(function ($tag) {
                return $tag->getRecord()->getRid();
            }, $tags);
            $event->setTags($tagsIds);
        } else {
            $event->setTags([$tags->getRecord()->getRid()]);
        }

        return $event;
    }

    /**
     * @param Event
     */
    public function saveEvent(Event $event)
    {
        $record = $event->getRecord();
        if ($event->getId()) {
            return $this->database->recordUpdate($record);
        }

        $record->setRid(new ID());
        return $this->database->recordCreate($event->getRecord());
    }

    /**
     * @param object record coming from the database
     * @return Event
     */
    public function createFromRecord(Record $record)
    {
        $event = new Event();
        $event->setRecord($record);

        return $event;
    }

    public function getEvent($id)
    {
        $event = $this->database->recordLoad(new ID($id))[0];

        return $event;
    }
}

<?php

namespace Marcosh\Eventgraph;

use PhpOrient\Protocols\Binary\Data\Record;

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
                return $tag->getRecord->getRid();
            }, $tags);
            $event->setTags($tagsIds);
        } else {
            $event->setTags(array($tags->getRecord()->getRid()));
        }

        return $event;
    }

    /**
     * @param Event
     */
    public function saveEvent(Event $event)
    {
        if ($event->getRecord()->getRid()) { //probably this is not right, but how to know the cluster?
            return $this->database->recordUpdate($event);
        }

        return $this->database->recordCreate($event);
    }

    /**
     * @param object record coming from the database
     * @return Event
     */
    private function createFromRecord(Record $record)
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

<?php

namespace Marcosh\Eventgraph;

class Events
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    /**
     * @param mixed Tag or array of Tags
     * @return event
     */
    public function createEvent($tags)
    {
        $event = new Event();

        if (is_array($tags)) {
            $event->setTags($tags);
        } else {
            $event->setTags(array($tags));
        }

        return $event;
    }
}

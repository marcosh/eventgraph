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

    /**
     * @param Event
     */
    public function saveEvent(Event $event)
    {
        $query = 'insert into Event set name = "%name%", ts = "%ts%"';
        $data = array(
            '%name%' => $event->getName(),
            'ts' => $event->getTs()
        );

        if ($event->getTags()) {
            $query .= ', tags = [%tags%]';
            $data['%tags%'] = implode(',', $event->getTags());
        }

        if ($event->getPrev()) {
            $query .= ', prev = {"%prevs%"}';
            $data['%prevs%'] = "";
        }

        if ($event->getNext()) {
            $query .= ', next = {"%nexts%"}';
            $data['%nexts%'] = "";
        }

        $this->database->command(strtr($query, $data));
    }
}

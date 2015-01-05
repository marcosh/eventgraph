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
     * @param string
     * @param mixed Tag or array of Tags
     * @return event
     */
    public function createEvent($name, $tags)
    {
        $event = new Event();
        $event->setName($name)->setTs(date("Y-m-d H:i:s"));

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
        $query = 'update Event set name = "%name%", ts = "%ts%", tags = [%tags%]';
        $data = array(
            '%name%' => $event->getName(),
            '%ts%' => $event->getTs(),
            '%tags%' => implode(',', $event->getTags())
        );

        if ($event->getPrev()) {
            $query .= ', prev = {"%prevs%"}';
            $data['%prevs%'] = "";
        }

        if ($event->getNext()) {
            $query .= ', next = {"%nexts%"}';
            $data['%nexts%'] = "";
        }
        $query .= 'upsert where name = "%name%", ts = "%ts%", tags = [%tags%]';

        $this->database->command(strtr($query, $data));
    }

    public function getEvent($id)
    {

    }
}

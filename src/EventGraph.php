<?php

namespace Marcosh\EventGraph;

use OrientDB\Client;

class EventGraph
{
    private $events;
    private $tags;

    /**
     * @param object OrientDb client
     * @param string name of the database
     * @return object
     */
    public function __construct($client, $databaseName)
    {
        $client->dbOpen($databaseName);

        $this->events = new Events($client);
        $this->tags = new Tags($client);
    }

    /**
     * creates a Tag object with the given tag
     *
     * @param string
     * @param boolean whether to persist the Tag to database immediately after creation
     * @return object the Tag
     */
    public function createTag($tagName, $save = true)
    {
        $tag = $this->tags->createTag($tagName);

        if ($save) {
            $this->tags->saveTag($tag);
        }

        return $tag;
    }

    /**
     * @param object Tag
     */
    public function saveTag(Tag $tag)
    {
        return $this->tags->saveTag($tag);
    }

    /**
     * @param string
     * @return object Tag
     */
    public function getTag($tagName)
    {
        return $this->tags->getTag($tagName);
    }

    /**
     * creates an event associated to the given tags
     *
     * @param mixed Tag or array of Tags
     * @return object the Event
     */
    public function createEvent($name, $tags, $save = true)
    {
        $event = $this->events->createEvent($name, $tags);

        if ($save) {
            $this->events->saveEvent($event);
        }

        return $event;
    }

    /**
     * @param Event
     */
    public function saveEvent(Event $event)
    {
        return $this->events->saveEvent($event);
    }

    /**
     * @param string
     * @return array of Events
     */
    public function getTagHistory($tagName)
    {
        return $this->tags->getTagHistory($tagName);
    }
}

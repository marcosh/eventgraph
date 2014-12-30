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
        $database = $client->getDatabase($databaseName);

        $this->events = new Events($database);
        $this->tags = new Tags($database);
    }

    /**
     * creates an event associated to the given tags
     *
     * @param mixed Tag or array of Tags
     * @return object the Event
     */
    public function createEvent($tags)
    {
        $event = new Event($tags);
        return $event;
    }

    /**
     * creates a Tag object with the given tag
     *
     * @param string
     * @return object the Tag
     */
    public function createTag($tag)
    {
        $tag = new Tag($tag);
        return $tag;
    }

    /**
     * creates an array of Tags from an array on strings
     *
     * @param array of strings
     * @return array of Tags
     */
    public function createTags(array $tags)
    {
        return array_map(function ($tag) {
            return $this->createTag($tag);
        }, $tags);
    }

    /**
     * @param string
     * @return object Tag
     */
    public function getTag($tag)
    {

    }
}

<?php

namespace Marcosh\EventGraph;

use OrientDB\Client;

class EventGraph
{
    // private $events;
    // private $tags;

    // /**
    //  * @param object OrientDb client
    //  * @param string name of the database
    //  * @return object
    //  */
    // public function __construct($client, $databaseName)
    // {
    //     $client->dbOpen($databaseName);

    //     $this->events = new Events($client);
    //     $this->tags = new Tags($client);
    // }

    // /**
    //  * creates a Tag object with the given tag
    //  *
    //  * @param string
    //  * @return object the Tag
    //  */
    // public function createTag($tag)
    // {
    //     return $this->tags->createTag($tag);
    // }

    // /**
    //  * @param object Tag
    //  */
    // public function saveTag(Tag $tag)
    // {
    //     return $this->tags->saveTag($tag);
    // }

    // /**
    //  * @param string
    //  * @return object Tag
    //  */
    // public function getTag($tag)
    // {
    //     return $this->tags->getTag($tag);
    // }

    // /**
    //  * creates an event associated to the given tags
    //  *
    //  * @param mixed Tag or array of Tags
    //  * @return object the Event
    //  */
    // public function createEvent($tags)
    // {
    //     return $this->events->createEvent($tags);
    // }

    // /**
    //  * @param Event
    //  */
    // public function saveEvent(Event $event)
    // {
    //     return $this->events->saveEvent($event);
    // }
}

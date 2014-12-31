<?php

namespace Marcosh\EventGraph;

class Event
{
    /**
     * @var array of tags
     */
    private $tags;

    /**
     * @var associative array mapping tags to events
     */
    private $prev;

    /**
     * @var associative array mapping tags to events
     */
    private $next;

    public function setPrev(Tag $tag, Event $event)
    {
        $this->prev[$tag->getName()] = $event;
    }

    public function getPrev(Tag $tag)
    {

    }

    public function setNext(Tag $tag, Event $event)
    {
        
    }

    public function getNext(Tag $tag)
    {

    }

    public function setTags(array $tags)
    {
        $this->tags = $tags;
    }

    public function getTags()
    {
        return $this->tags;
    }
}

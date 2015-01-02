<?php

namespace Marcosh\EventGraph;

class Event
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string date
     */
    private $ts;

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

    /**
     * @param string
     * @return Event
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string date
     * @return Event
     */
    public function setTs($ts)
    {
        $this->ts = $ts;
        return $this;
    }

    /**
     * @return string date
     */
    public function getTs()
    {
        return $this->ts;
    }

    /**
     * @param string
     * @param string id of the event
     * @return Event
     */
    public function setPrev($tag, $event)
    {
        $this->prev[$tag] = $event;
        return $this;
    }

    /**
     * @param string
     * @return string id of the event
     */
    public function getPrev($tag)
    {
        return $this->prev[$tag];
    }

    /**
     * @param string
     * @param string id of the event
     * @return Event
     */
    public function setNext($tag, $event)
    {
        $this->next[$tag] = $event;
        return $this;
    }

    /**
     * @param string
     * @return string id of the event
     */
    public function getNext($tag)
    {
        return $this->next[$tag];
    }

    /**
     * @param array of Tags
     * @return Event
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
    }

    public function getTags()
    {
        return $this->tags;
    }
}

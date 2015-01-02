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
     * @return mixed string id of the event or
     *      associative array with tags mapping to their previous event
     */
    public function getPrev($tag = null)
    {
        if ($tag === null) {
            return $this->prev;
        }

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
     * @return mixed string id of the event or
     *      associative array with tags mapping to their previous event
     */
    public function getNext($tag = null)
    {
        if ($tag === null) {
            return $this->next;
        }

        return $this->next[$tag];
    }

    /**
     * @param string
     * @return Event
     */
    public function addTag($tag)
    {
        $this->tags[] = $tag;
        return $this;
    }

    /**
     * @param array of strings
     * @return Event
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
        return $this;
    }

    public function getTags()
    {
        return $this->tags;
    }
}

<?php

namespace Marcosh\EventGraph;

class Tag
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Event
     */
    private $first;

    /**
     * @var Event
     */
    private $last;

    /**
     * @param string
     * @return Tag
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
     * @param string
     * @return Tag
     */
    public function setFirstEvent($event)
    {
        $this->first = $event;
        return $this;
    }

    /**
     * @return string id of the event
     */
    public function getFirstEvent()
    {
        return $this->first;
    }

    /**
     * @param string
     * @return Tag
     */
    public function setLastEvent($event)
    {
        $this->last = $event;
        return $this;
    }

    /**
     * @return string id of the event
     */
    public function getLastEvent()
    {
        return $this->last;
    }
}

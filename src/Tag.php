<?php

namespace Marcosh\EventGraph;

class Tag
{
    /**
     * @var string
     */
    private $name;

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

    public function getHistory()
    {

    }

    public function getFirstEvent()
    {

    }

    public function getLastEvent()
    {
        
    }
}

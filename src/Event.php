<?php

namespace Marcosh\EventGraph;

class Event
{
    private $tags;
    private $prev;
    private $next;

    public function __construct($tags)
    {
        if (is_array($tags)) {
            $this->tags = $tags;
        } else if ($tags instanceof Tag) {
            $this->tags = array($tags);
        }
    }

    public function getPrev(Tag $tag)
    {

    }

    public function getNext(Tag $tag)
    {

    }

    public function getTags()
    {
        return $this->tags;
    }
}

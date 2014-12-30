<?php

namespace Marcosh\EventGraph;

class EventTest extends \PHPUnit_Framework_TestCase
{
    /*public function setUp()
    {

    }*/

    public function testOnlyEventReturnsNullPrevEvent()
    {
        $tag = new Tag('tag');
        $event = new Event($tag);
        $this->assertNull($event->getPrev($tag));
    }

    public function testOnlyEventReturnsNullNextEvent()
    {
        $tag = new Tag('tag');
        $event = new Event($tag);
        $this->assertNull($event->getNext($tag));
    }

    public function testEventHasCorrectTags()
    {
        $tag1 = new Tag('tag1');
        $tag2 = new Tag('tag2');
        $tags = array($tag1, $tag2);
        $event = new Event($tags);
        $this->assertEquals($tags, $event->getTags());
    }
}

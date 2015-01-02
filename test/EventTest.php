<?php

namespace Marcosh\EventGraph;

class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testName()
    {
        $name = 'event';
        $event = new Event();
        $event->setName($name);
        $this->assertEquals($name, $event->getName());
    }

    public function testTs()
    {
        $ts = '2015-01-02';
        $event = new Event();
        $event->setTs($ts);
        $this->assertEquals($ts, $event->getTs());
    }

    public function testTags()
    {
        $tags = ['tag1', 'tag2'];
        $event = new Event();
        $event->setTags($tags);
        $this->assertEquals($tags, $event->getTags());
    }

    public function testSingleAddedTags()
    {
        $tag1 = 'tag1';
        $tag2 = 'tag2';
        $event = new Event();
        $event->addTag($tag1);
        $event->addTag($tag2);
        $this->assertEquals([$tag1, $tag2], $event->getTags());
    }

    public function testPrev()
    {
        $tag = 'tag';
        $prev = '#0:0';
        $event = new Event();
        $event->setPrev($tag, $prev);
        $this->assertEquals($prev, $event->getPrev($tag));
    }

    public function testPrevArray()
    {
        $tag = 'tag';
        $prev = '#0:0';
        $event = new Event();
        $event->setPrev($tag, $prev);
        $this->assertEquals([$tag => $prev], $event->getPrev());
    }

    public function testNext()
    {
        $tag = 'tag';
        $next = '#0:1';
        $event = new Event();
        $event->setNext($tag, $next);
        $this->assertEquals($next, $event->getNext($tag));
    }

    public function testArrayNext()
    {
        $tag = 'tag';
        $next = '#0:1';
        $event = new Event();
        $event->setNext($tag, $next);
        $this->assertEquals([$tag => $next], $event->getNext());
    }

    public function testOnlyEventReturnsNullPrevEvent()
    {
        $event = new Event();
        $this->assertNull($event->getPrev('tag'));
    }

    public function testOnlyEventReturnsNullNextEvent()
    {
        $event = new Event();
        $this->assertNull($event->getNext('tag'));
    }
}

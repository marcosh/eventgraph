<?php

namespace Marcosh\EventGraph;

use Marcosh\EventGraph\EventGraph;

class EventGraphTest extends \PHPUnit_Framework_TestCase
{
    private $client;
    private $eventGraph;

    public function setUp()
    {
        $this->client = \Mockery::mock();
        $this->client->shouldReceive('getDatabase');
        $this->eventGraph = new EventGraph($this->client, 'dbName');
    }

    public function testCreateTag()
    {
        $this->assertEquals(
            new Tag('tag'),
            $this->eventGraph->createTag('tag')
        );
    }

    public function testCreateTags()
    {
        $this->assertEquals(
            array(new Tag('tag1'), new Tag('tag2')),
            $this->eventGraph->createTags(array('tag1', 'tag2'))
        );
    }

    public function testCreateEvent()
    {
        $tag = $this->eventGraph->createTag('tag');
        $this->assertEquals(
            new Event($tag),
            $this->eventGraph->createEvent($tag)
        );
    }
}

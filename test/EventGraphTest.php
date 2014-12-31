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
        $this->client->shouldReceive('dbOpen');
        $this->eventGraph = new EventGraph($this->client, 'dbName');
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    public function testCreateTag()
    {
        $tag = new Tag();
        $tag->setName('tag');
        $this->assertEquals(
            $tag,
            $this->eventGraph->createTag('tag')
        );
    }

    public function testCreateEvent()
    {
        $tag = $this->eventGraph->createTag('tag');
        $event = new Event();
        $event->setTags(array($tag));
        $this->assertEquals(
            $event,
            $this->eventGraph->createEvent($tag)
        );
    }

    public function testSaveTag()
    {
        $this->client->shouldReceive('command')->once()
            ->with('insert into Tag set name = "tag"');

        $tag = $this->eventGraph->createTag('tag');
        $this->eventGraph->saveTag($tag);
    }

    public function testGetTag()
    {
        $tag = new \PhpOrient\Protocols\Binary\Data\Record();
        $tag->setOData(array('name' => 'tag'));

        $this->client->shouldReceive('query')->once()
            ->with('select from Tag where name = "tag"')
            ->andReturn(array($tag));

        $this->eventGraph->getTag('tag');
    }
}

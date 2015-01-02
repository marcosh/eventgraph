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

    public function testSaveTagWithoutEvents()
    {
        $this->client->shouldReceive('command')->once()
            ->with('insert into Tag set name = "tag"');

        $tag = $this->eventGraph->createTag('tag');
        $this->eventGraph->saveTag($tag);
    }

    public function testSaveTagWithFirstEvent()
    {
        $this->client->shouldReceive('command')->once()
            ->with('insert into Tag set name = "tag", first = "#1:1"');

        $tag = $this->eventGraph->createTag('tag')->setFirstEvent('#1:1');
        $this->eventGraph->saveTag($tag);
    }

    public function testSaveTagWithLastEvent()
    {
        $this->client->shouldReceive('command')->once()
            ->with('insert into Tag set name = "tag", last = "#1:1"');

        $tag = $this->eventGraph->createTag('tag')->setLastEvent('#1:1');
        $this->eventGraph->saveTag($tag);
    }

    public function testSaveTagWithFirstAndLastEvent()
    {
        $this->client->shouldReceive('command')->once()
            ->with('insert into Tag set name = "tag", first = "#1:1", last = "#1:2"');

        $tag = $this->eventGraph->createTag('tag')
            ->setFirstEvent('#1:1')->setLastEvent('#1:2');
        $this->eventGraph->saveTag($tag);
    }

    public function testGetTag()
    {
        $tag = new \PhpOrient\Protocols\Binary\Data\Record();
        $tag->setOData(array(
            'name' => 'tag',
            'first' => '#1:1',
            'last' => '#1:2'
        ));

        $this->client->shouldReceive('query')->once()
            ->with('select from Tag where name = "tag"')
            ->andReturn(array($tag));

        $this->eventGraph->getTag('tag');
    }
}

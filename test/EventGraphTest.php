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

    public function testCreateTagAndPersist()
    {

    }

    public function testCreateTagWithoutPersisting()
    {
        $tag = $this->eventGraph->createTag('tag', false);

        $this->assertEquals('Tag', $tag->getRecord()->getOClass());
    }

    public function testSaveTag()
    {

    }

    public function testGetTag()
    {

    }

    public function testCreateEvent()
    {

    }

    public function testSaveEvent()
    {

    }

    public function testGetTagHistory()
    {

    }
}

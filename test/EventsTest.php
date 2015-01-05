<?php

namespace Marcosh\EventGraph;

use PhpOrient\Protocols\Binary\Data\Record;

class EventsTest extends \PHPUnit_Framework_TestCase
{
    private $sut;

    private $database;

    public function setUp()
    {
        $this->database = \Mockery::mock();

        $this->sut = new Events($this->database);
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    public function testCreateEventWithSingleTag()
    {
        $tag = new Tag();
        $event = new Event();
        $event->setName('event')->setTs(date("Y-m-d H:i:s"))
            ->setTags(array($tag));

        $this->assertEquals(
            $event,
            $this->sut->createEvent('event', array($tag))
        );
    }

    public function testCreateEventWithMultipleTags()
    {
        $tag1 = new Tag();
        $tag2 = new Tag();
        $tags = array($tag1, $tag2);
        $event = new Event();
        $event->setName('event')->setTs(date("Y-m-d H:i:s"))
            ->setTags($tags);

        $this->assertEquals(
            $event,
            $this->sut->createEvent('event', $tags)
        );
    }

    public function testSaveEventWithoutPrevNext()
    {
        /*$this->database->shouldReceive('command')->once()
            ->with(
                'update Event set name = "name", ts = "2015-01-01", tags = [#0:0]'.
                'upsert where name = "name", ts = "2015-01-01", tags = [#0:0]'
            );

        $event = $this->sut->createEvent('name', );*/
    }
}

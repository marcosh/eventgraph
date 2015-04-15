<?php

namespace Marcosh\EventGraph;

use PhpOrient\Protocols\Binary\Data\Record;
use PhpOrient\Protocols\Binary\Data\ID;

class EventsTest extends \PHPUnit_Framework_TestCase
{
    private $sut;
    private $tags;

    private $database;

    public function setUp()
    {
        $this->database = \Mockery::mock();

        $this->sut = new Events($this->database);
        $this->tags = new Tags($this->database);
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    public function testCreateEventWithSingleTag()
    {
        $tag = new Tag();
        $tag->getRecord()->setRid(new ID(1, 1));
        $event = new Event();
        $event->setName('event')->setTs(date("Y-m-d H:i:s"))
            ->setTags([$tag->getId()]);

        $this->assertEquals(
            $event,
            $this->sut->createEvent('event', [$tag])
        );
    }

    public function testCreateEventWithMultipleTags()
    {
        $tag1 = new Tag();
        $tag1->getRecord()->setRid(new ID(1, 1));
        $tag2 = new Tag();
        $tag2->getRecord()->setRid(new ID(1, 2));
        $tags = [$tag1, $tag2];
        $tagsIds = array_map(function ($tag) {
            return $tag->getId();
        }, $tags);
        $event = new Event();
        $event->setName('event')->setTs(date("Y-m-d H:i:s"))
            ->setTags($tagsIds);

        $this->assertEquals(
            $event,
            $this->sut->createEvent('event', $tags)
        );
    }

    public function testInsertEventMultipleTags()
    {
        $tag1 = new Tag();
        $tag1->getRecord()->setRid(new ID(1, 1));
        $tag2 = new Tag();
        $tag2->getRecord()->setRid(new ID(1, 2));
        $tags = [$tag1, $tag2];
        $event = $this->sut->createEvent('event', $tags);
        $this->database->shouldReceive('recordCreate')->once()
            ->with($event->getRecord());

        $this->sut->saveEvent($event);
    }

    public function testInsertEventWithOneTag()
    {
        $tag = new Tag();
        $tag->getRecord()->setRid(new ID(1, 1));
        $event = $this->sut->createEvent('event', $tag);
        $this->database->shouldReceive('recordCreate')->once()
            ->with($event->getRecord());

        $this->sut->saveEvent($event);
    }

    public function testSaveEventWithMultipleTags()
    {
        $tag1 = new Tag();
        $tag1->getRecord()->setRid(new ID(1, 1));
        $tag2 = new Tag();
        $tag2->getRecord()->setRid(new ID(1, 2));
        $tags = [$tag1, $tag2];
        $event = $this->sut->createEvent('event', $tags);
        $event->getRecord()->setRid(new ID(2, 1));
        $this->database->shouldReceive('recordUpdate')->once()
            ->with($event->getRecord());

        $this->sut->saveEvent($event);
    }

    public function testSaveEventWithOneTag()
    {
        $tag = new Tag();
        $tag->getRecord()->setRid(new ID(1, 1));
        $event = $this->sut->createEvent('event', $tag);
        $event->getRecord()->setRid(new ID(2, 1));
        $this->database->shouldReceive('recordUpdate')->once()
            ->with($event->getRecord());

        $this->sut->saveEvent($event);
    }
}

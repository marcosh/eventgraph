<?php

namespace Marcosh\EventGraph;

use PhpOrient\Protocols\Binary\Data\Record;
use PhpOrient\Protocols\Binary\Data\ID;

class TagsTest extends \PHPUnit_Framework_TestCase
{
    private $sut;

    private $events;

    private $database;

    public function setUp()
    {
        $this->database = \Mockery::mock();
        $this->sut = new Tags($this->database);
        $this->events = new Events($this->database);
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    public function testCreateTag()
    {
        $tag = new Tag();
        $tag->setName('tag');
        $this->assertEquals($tag, $this->sut->createTag('tag'));
    }

    public function testCreateFromRecord()
    {
        $method = new \ReflectionMethod(
            '\Marcosh\EventGraph\Tags',
            'createFromRecord'
        );
        $method->setAccessible(true);

        $data = new Record();
        $history = [new ID(0, 0), new ID(0, 1)];
        $data->setOClass('Tag')
            ->setOData([
                'name' => 'tag',
                'history' => $history
        ]);
        $tag = new Tag();
        $tag->setName('tag');
        $tag->setHistory($history);
        $this->assertEquals($tag, $method->invoke($this->sut, $data));
    }

    public function testGetTag()
    {
        $data = new Record();
        $history = [new ID(0, 0), new ID(0, 1)];
        $data->setOClass('Tag')
            ->setOData([
                '@rid' => new ID(0, 0),
                'name' => 'tag',
                'history' => $history
        ]);

        $query = 'select from Tag where name = "tag"';
        $this->database->shouldReceive('query')->once()->with($query)
            ->andReturn([$data]);

        $this->sut->getTag('tag');
    }

    public function testInsertTagWithHistory()
    {
        $history = [new ID(0, 0)];
        $tag = $this->sut->createTag('tag')->setHistory($history);
        $this->database->shouldReceive('recordCreate')->once()
            ->with($tag->getRecord());

        $this->sut->saveTag($tag);
    }

    public function testInsertTagWithoutHistory()
    {
        $tag = $this->sut->createTag('tag');
        $this->database->shouldReceive('recordCreate')->once()
            ->with($tag->getRecord());

        $this->sut->saveTag($tag);
    }

    public function testSaveTagWithHistory()
    {
        $history = [new ID(0, 0)];
        $tag = $this->sut->createTag('tag')->setHistory($history);
        $tag->getRecord()->setRid(new ID(1, 1));
        $this->database->shouldReceive('recordUpdate')->once()
            ->with($tag->getRecord());

        $this->sut->saveTag($tag);
    }

    public function testSaveTagWithoutHistory()
    {
        $tag = $this->sut->createTag('tag');
        $tag->getRecord()->setRid(new ID(1, 1));
        $this->database->shouldReceive('recordUpdate')->once()
            ->with($tag->getRecord());

        $this->sut->saveTag($tag);
    }

    public function testGetTagHistory()
    {
        $tag = $this->sut->createTag('tag');
        $event1 = $this->events->createEvent('event1', $tag);
        $event2 = $this->events->createEvent('event2', $tag);

        $this->database->shouldReceive('select expand(history) from Tag where name = "tag"');
    }
}

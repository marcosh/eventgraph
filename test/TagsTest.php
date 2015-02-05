<?php

namespace Marcosh\EventGraph;

use PhpOrient\Protocols\Binary\Data\Record;
use PhpOrient\Protocols\Binary\Data\ID;

class TagsTest extends \PHPUnit_Framework_TestCase
{
    private $sut;

    private $database;

    public function setUp()
    {
        $this->database = \Mockery::mock();
        $this->sut = new Tags($this->database);
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
        $data->setOClass('Tag')
            ->setOData(array(
                'name' => 'tag',
                'history' => ['#0:0', '#0:1']
        ));
        $tag = new Tag();
        $tag->setName('tag');
        $tag->setHistory(['#0:0', '#0:1']);
        $this->assertEquals($tag, $method->invoke($this->sut, $data));
    }

    public function testGetTag()
    {
        $data = new Record();
        $data->setOClass('Tag')
            ->setOData(array(
                '@rid' => '#1:1',
                'name' => 'tag',
                'history' => ['#0:0', '#0:1']
        ));

        $query = 'select from Tag where name = "tag"';
        $this->database->shouldReceive('query')->once()->with($query)
            ->andReturn(array($data));

        $this->sut->getTag('tag');
    }

    public function testInsertTagWithoutEvents()
    {
        $tag = $this->sut->createTag('tag');
        $this->database->shouldReceive('recordCreate')->once()
            ->with($tag->getRecord());

        $this->sut->saveTag($tag);
    }

    public function testSaveTagWithHistory()
    {
        $history = array('#0:0');
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
}

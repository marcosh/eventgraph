<?php

namespace Marcosh\EventGraph;

use PhpOrient\Protocols\Binary\Data\Record;

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

    // public function testInsertTagWithoutEvents()
    // {
    //     $this->database->shouldReceive('command')->once()
    //         ->with('insert into Tag set name = "tag" upsert where name = "tag"');

    //     $tag = $this->sut->createTag('tag');
    //     $this->sut->saveTag($tag);
    // }

    // public function testSaveTagWithFirstEvent()
    // {
    //     $this->database->shouldReceive('command')->once()
    //         ->with(
    //             'update Tag set name = "tag", first = #1:1 '.
    //             'upsert where name = "tag"'
    //         );

    //     $tag = $this->sut->createTag('tag')->setFirstEvent('#1:1');
    //     $this->sut->saveTag($tag);
    // }

    // public function testSaveTagWithLastEvent()
    // {
    //     $this->database->shouldReceive('command')->once()
    //         ->with(
    //             'update Tag set name = "tag", last = #1:1 '.
    //             'upsert where name = "tag"'
    //         );

    //     $tag = $this->sut->createTag('tag')->setLastEvent('#1:1');
    //     $this->sut->saveTag($tag);
    // }

    // public function testSaveTagWithFirstAndLastEvent()
    // {
    //     $this->database->shouldReceive('command')->once()
    //         ->with(
    //             'update Tag set name = "tag", first = #1:1, last = #1:2 '.
    //             'upsert where name = "tag"'
    //         );

    //     $tag = $this->sut->createTag('tag')
    //         ->setFirstEvent('#1:1')->setLastEvent('#1:2');
    //     $this->sut->saveTag($tag);
    // }
}

<?php

namespace Marcosh\EventGraph;

use PhpOrient\Protocols\Binary\Data\Record;

class TagTest extends \PHPUnit_Framework_TestCase
{
    public function testCreationCreatesTagRecord()
    {
        $tag = new Tag();
        $record = $tag->getRecord();
        $this->assertEquals('Tag', $record->getOClass());
    }

    public function testSetName()
    {
        $name = 'name';
        $tag = new Tag();
        $tag->setName($name);
        $record = $tag->getRecord();
        $this->assertEquals($name, $record->getOData()['name']);
    }

    public function testGetName()
    {
        $name = 'tag';
        $tag = new Tag();
        $tag->setName($name);
        $this->assertEquals($name, $tag->getName());
    }

    public function testSetHistory()
    {
        $history = array('#0:0', '#0:1');
        $tag = new Tag();
        $tag->setHistory($history);
        $record = $tag->getRecord();
        $this->assertEquals($history, $record->getOData()['history']);
    }

    public function testGetHistory()
    {
        $history = array('#0:0', '#0:1');
        $tag = new Tag();
        $tag->setHistory($history);
        $this->assertEquals($history, $tag->getHistory());
    }

    public function testAddEvent()
    {
        $event = '#0:0';
        $tag = new Tag();
        $tag->addEvent($event);
        $record = $tag->getRecord();
        $this->assertEquals(array($event), $record->getOData()['history']);
    }

    public function testAddEventFromEmptyHistory()
    {
        $event = '#0:0';
        $tag = new Tag();
        $tag->addEvent($event);
        $this->assertEquals(array($event), $tag->getHistory());
    }

    public function testAddEventToPoupulatedHistory()
    {
        $history = array('#0:0');
        $event = '#0:1';
        $tag = new Tag();
        $tag->setHistory($history);
        $tag->addEvent($event);
        array_push($history, $event);
        $this->assertEquals($history, $tag->getHistory());
    }

    public function testNewTagHasEmptyHistory()
    {
        $tag = new Tag();
        $this->assertEmpty($tag->getHistory());
    }

    /**
     * @expectedException Exception
     */
    public function testSetRecordThrowsIfWrongClass()
    {
        $record = new Record();
        $record->setOClass('NotATag');
        $tag = new Tag();
        $tag->setRecord($record);
    }
}

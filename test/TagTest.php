<?php

namespace Marcosh\EventGraph;

use PhpOrient\Protocols\Binary\Data\Record;
use PhpOrient\Protocols\Binary\Data\ID;

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
        $history = array(new ID(0, 0), new ID(0, 1));
        $tag = new Tag();
        $tag->setHistory($history);
        $record = $tag->getRecord();
        $this->assertEquals($history, $record->getOData()['history']);
    }

    public function testGetHistory()
    {
        $history = array(new ID(0, 0), new ID(0, 1));
        $tag = new Tag();
        $tag->setHistory($history);
        $this->assertEquals($history, $tag->getHistory());
    }

    public function testAddEvent()
    {
        $event = new ID(0, 0);
        $tag = new Tag();
        $tag->addEvent($event);
        $record = $tag->getRecord();
        $this->assertEquals(array($event), $record->getOData()['history']);
    }

    public function testAddEventToEmptyHistory()
    {
        $event = new ID(0, 0);
        $tag = new Tag();
        $tag->addEvent($event);
        $this->assertEquals(array($event), $tag->getHistory());
    }

    public function testAddEventToPoupulatedHistory()
    {
        $history = array(new ID(0, 0));
        $event = new ID(0, 1);
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

    public function testSetRecordSetsCorrectName()
    {
        $record = new Record();
        $record->setOClass('Tag');
        $name = 'name';
        $data = ['name' => $name];
        $record->setOData($data);
        $tag = new Tag();
        $tag->setRecord($record);
        $this->assertEquals($name, $tag->getName());
    }

    public function testSetRecordSetsCorrectHistory()
    {
        $record = new Record();
        $record->setOClass('Tag');
        $history = [new ID(0, 0), new ID(0, 1)];
        $data = ['history' => $history];
        $record->setOData($data);
        $tag = new Tag();
        $tag->setRecord($record);
        $this->assertEquals($history, $tag->getHistory());
    }

    public function testGetRecord()
    {
        $record = new Record();
        $record->setOClass('Tag');
        $name = 'name';
        $history = [new ID(0, 0), new ID(0, 1)];
        $data = [
            'name' => $name,
            'history' => $history
        ];
        $record->setOData($data);
        $tag = new Tag();
        $tag->setRecord($record);
        $this->assertEquals($record, $tag->getRecord());
    }

    public function testGetRecordRetrievesNameAndHistory()
    {
        $name = 'name';
        $history = [new ID(0, 0), new ID(0, 1)];
        $tag = new Tag();
        $tag->setName($name);
        $tag->setHistory($history);
        $data = [
            'name' => $name,
            'history' => $history
        ];
        $this->assertEquals($data, $tag->getRecord()->getOData());
    }
}

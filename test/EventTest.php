<?php

namespace Marcosh\EventGraph;

use PhpOrient\Protocols\Binary\Data\Record;

class EventTest extends \PHPUnit_Framework_TestCase
{
    public function testCreationCreatesEventRecord()
    {
        $event = new Event();
        $record = $event->getRecord();
        $this->assertEquals('Event', $record->getOClass());
    }

    public function testSetName()
    {
        $name = 'name';
        $event = new Event();
        $event->setName($name);
        $record = $event->getRecord();
        $this->assertEquals($name, $record->getOData()['name']);
    }

    public function testGetName()
    {
        $name = 'event';
        $event = new Event();
        $event->setName($name);
        $this->assertEquals($name, $event->getName());
    }

    public function testSetTs()
    {
        $ts = 1234567890;
        $event = new Event();
        $event->setTs($ts);
        $record = $event->getRecord();
        $this->assertEquals($ts, $record->getOData()['ts']);
    }

    public function testGetTs()
    {
        $ts = 1234567890;
        $event = new Event();
        $event->setTs($ts);
        $this->assertEquals($ts, $event->getTs());
    }

    public function testSetTags()
    {
        $tags = array('#0:0', '#0:1');
        $event = new Event();
        $event->setTags($tags);
        $record = $event->getRecord();
        $this->assertEquals($tags, $record->getOData()['tags']);
    }

    public function testGetTags()
    {
        $tags = array('#0:0', '#0:1');
        $event = new Event();
        $event->setTags($tags);
        $this->assertEquals($tags, $event->getTags());
    }

    public function testAddTag()
    {
        $tag = '#0:0';
        $event = new Event();
        $event->addTag($tag);
        $record = $event->getRecord();
        $this->assertEquals(array($tag), $record->getOData()['tags']);
    }

    public function testAddTagToEmptyHistory()
    {
        $tag = '#0:0';
        $event = new Event();
        $event->addTag($tag);
        $this->assertEquals(array($tag), $event->getTags());
    }

    public function testAddTagToPoupulatedTags()
    {
        $tags = array('#0:0');
        $tag = '#0:1';
        $event = new Event();
        $event->setTags($tags);
        $event->addTag($tag);
        array_push($tags, $tag);
        $this->assertEquals($tags, $event->getTags());
    }

    public function testNewEventHasEmptyTags()
    {
        $event = new Event();
        $this->assertEmpty($event->getTags());
    }

    /**
     * @expectedException Exception
     */
    public function testSetRecordThrowsIfWrongClass()
    {
        $record = new Record();
        $record->setOClass('NotAnEvent');
        $event = new Event();
        $event->setRecord($record);
    }

    public function testSetRecordSetsCorrectName()
    {
        $record = new Record();
        $record->setOClass('Event');
        $name = 'name';
        $data = ['name' => $name];
        $record->setOData($data);
        $event = new Event();
        $event->setRecord($record);
        $this->assertEquals($name, $event->getName());
    }

    public function testSetRecordSetsCorrectTs()
    {
        $record = new Record();
        $record->setOClass('Event');
        $ts = 1234567890;
        $data = ['ts' => $ts];
        $record->setOData($data);
        $event = new Event();
        $event->setRecord($record);
        $this->assertEquals($ts, $event->getTs());
    }

    public function testSetRecordSetsCorrectTags()
    {
        $record = new Record();
        $record->setOClass('Event');
        $tags = ['#0:0', '#0:1'];
        $data = ['tags' => $tags];
        $record->setOData($data);
        $event = new Event();
        $event->setRecord($record);
        $this->assertEquals($tags, $event->getTags());
    }

    public function testGetRecord()
    {
        $record = new Record();
        $record->setOClass('Event');
        $name = 'name';
        $ts = 1234567890;
        $tags = ['#0:0', '#0:1'];
        $data = [
            'name' => $name,
            'ts' => $ts,
            'tags' => $tags
        ];
        $record->setOData($data);
        $event = new Event();
        $event->setRecord($record);
        $this->assertEquals($record, $event->getRecord());
    }

    public function testGetRecordRetrievesNameTsAndTags()
    {
        $name = 'name';
        $ts = 1234567890;
        $tags = ['#0:0', '#0:1'];
        $event = new Event();
        $event->setName($name);
        $event->setTs($ts);
        $event->setTags($tags);
        $data = [
            'name' => $name,
            'ts' => $ts,
            'tags' => $tags
        ];
        $this->assertEquals($data, $event->getRecord()->getOData());
    }
}

<?php

namespace Marcosh\EventGraph;

use PhpOrient\Protocols\Binary\Data\Record;

class Event
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string date
     */
    private $ts;

    /**
     * @var array of tags
     */
    private $tags;

    /**
     * @var Record
     */
    private $record;

    public function __construct()
    {
        $this->record = $this->createEventRecord();
    }

    /**
     * @param string
     * @return Event
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->saveToRecord();
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string date
     * @return Event
     */
    public function setTs($ts)
    {
        $this->ts = $ts;
        $this->saveToRecord();
        return $this;
    }

    /**
     * @return string date
     */
    public function getTs()
    {
        return $this->ts;
    }

    /**
     * @param string id of the Tag
     * @return Event
     */
    public function addTag($tag)
    {
        $this->tags[] = $tag;
        $this->saveToRecord();
        return $this;
    }

    /**
     * @param array of strings, id of Tags
     * @return Event
     */
    public function setTags(array $tags)
    {
        $this->tags = $tags;
        $this->saveToRecord();
        return $this;
    }

    /**
     * @return array of Tag ids
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * @param Record
     * @return Tag
     */
    public function setRecord(Record $record)
    {
        if ($record->getOClass() != 'Event') {
            throw new \Exception('A Tag object can have only a "Event" record');
        }

        $this->record = $record;
        $data = $record->getOData();

        if (isset($data['name'])) {
            $this->name = $data['name'];
        }

        if (isset($data['ts'])) {
            $this->ts = $data['ts'];
        }

        if (isset($data['tags'])) {
            $this->tags = $data['tags'];
        }
        return $this;
    }

    /**
     * @return Record
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * @return Record
     */
    private function createEventRecord()
    {
        $record = new Record();
        $record->setOClass('Event');
        return $record;
    }

    private function saveToRecord()
    {
        $data = [
            'name' => $this->name,
            'ts' => $this->ts,
            'tags' => $this->tags
        ];
        $this->record->setOData($data);
    }
}

<?php

namespace Marcosh\EventGraph;

use PhpOrient\Protocols\Binary\Data\Record;

class Tag
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var array
     */
    private $history;

    /**
     * underlying Orient database record
     */
    private $record;

    public function __construct()
    {
        $this->record = $this->createTagRecord();
    }

    /**
     * @param string
     * @return Tag
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
     * @param array of Event ids
     * @return Tag
     */
    public function setHistory(array $history)
    {
        $this->history = $history;
        $this->saveToRecord();
        return $this;
    }

    /**
     * @param string Event id //TODO: are we sure we are using strings?
     * @return Tag
     */
    public function addEvent($eventId)
    {
        $this->history[] = $eventId;
        $this->saveToRecord();
        return $this;
    }

    /**
     * @return array of Event ids
     */
    public function getHistory()
    {
        return $this->history;
    }

    /**
     * @param Record
     * @return Tag
     */
    public function setRecord(Record $record)
    {
        if ($record->getOClass() != 'Tag') {
            throw new \Exception('A Tag object can have only a "Tag" record');
        }

        $this->record = $record;
        $data = $record->getOData();

        if (isset($data['name'])) {
            $this->name = $data['name'];
        }

        if (isset($data['history'])) {
            $this->history = $data['history'];
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
     * @return Rid
     */
    public function getId()
    {
        return $this->record->getRid();
    }

    /**
     * @return Record
     */
    private function createTagRecord()
    {
        $record = new Record();
        $record->setOClass('Tag');
        return $record;
    }

    private function saveToRecord()
    {
        $data = [];
        if ($this->name) {
            $data['name'] = $this->name;
        }
        if ($this->history) {
            $data['history'] = $this->history;
        }
        $this->record->setOData($data);
    }
}

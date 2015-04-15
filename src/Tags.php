<?php

namespace Marcosh\EventGraph;

use PhpOrient\Protocols\Binary\Data\Record;
use PhpOrient\Protocols\Binary\Data\ID;

class Tags
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }

    /**
     * @param string
     * @return Tag
     */
    public function createTag($tagName)
    {
        $tag = new Tag();
        $tag->setName($tagName);

        return $tag;
    }

    /**
     * @param object record coming from the database
     * @return Tag
     */
    private function createFromRecord(Record $record)
    {
        $tag = new Tag();
        $tag->setRecord($record);

        return $tag;
    }

    /**
     * @param string
     * @return Tag
     */
    public function getTag($tagName)
    {
        $query = 'select from Tag where name = "%tagName%"';
        $data = ['%tagName%' => $tagName];
        $tagData = $this->database->query(strtr($query, $data));
        return $this->createFromRecord($tagData[0]);
    }

    /**
     * @param Tag
     * @return string tag id
     */
    public function saveTag($tag)
    {
        $record = $tag->getRecord();
        if ($tag->getId()) {
            return $this->database->recordUpdate($record);
        }

        $record->setRid(new ID());
        return $this->database->recordCreate($record);
    }

    /**
     * @param string
     * @return array of Events
     */
    public function getTagHistory($tagName)
    {
        $query = 'select expand(history) from Tag where name = "%tagName%"';
        $data = ['%tagName%' => $tagName];
        $events = $this->database->query(strtr($query, $data));

        //TODO: hidrate events to Events
    }
}

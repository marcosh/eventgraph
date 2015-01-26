<?php

namespace Marcosh\EventGraph;

use PhpOrient\Protocols\Binary\Data\Record;

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
        $data = array('%tagName%' => $tagName);
        $tagData = $this->database->query(strtr($query, $data));
        return $this->createFromData($tagData[0]);
    }

    /**
     * @param Tag
     * @return string tag id
     */
    public function saveTag($tag)
    {
        if ($tag->getRecord()->getRid()) { //probably this is not right, but how to know the cluster?
            return $this->database->recordUpdate($tag);
        }

        return $this->database->recordCreate($tag);
    }
}

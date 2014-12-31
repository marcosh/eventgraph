<?php

namespace Marcosh\EventGraph;

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
    public function createFromData(\PhpOrient\Protocols\Binary\Data\Record $record)
    {
        return $this->createTag($record->getOData()['name']);
    }

    /**
     * @param string
     * @return Tag
     */
    public function getTag($tagName)
    {
        $query = sprintf('select from Tag where name = "%s"', $tagName);
        $tagData = $this->database->query($query);
        $tag = $this->createFromData($tagData[0]);
    }

    /**
     * @param Tag
     */
    public function saveTag($tag)
    {
        $query = sprintf('insert into Tag set name = "%s"', $tag->getName());
        $this->database->command($query);
    }
}

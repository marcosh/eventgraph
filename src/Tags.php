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
        var_dump($tag);
    }
}

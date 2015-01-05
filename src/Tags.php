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
    private function createFromData(\PhpOrient\Protocols\Binary\Data\Record $record)
    {
        $data = $record->getOData();

        $tag = new Tag();
        $tag->setName($data['name'])
            ->setFirstEvent($data['first'])
            ->setLastEvent($data['last']);
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
        $tag = $this->createFromData($tagData[0]);
    }

    /**
     * @param Tag
     */
    public function saveTag($tag)
    {
        $query = 'update Tag set name = "%tagName%"';
        $data = array('%tagName%' => $tag->getName());

        if ($tag->getFirstEvent()) {
            $query .= ', first = %first%';
            $data['%first%'] = $tag->getFirstEvent();
        }

        if ($tag->getLastEvent()) {
            $query .= ', last = %last%';
            $data['%last%'] = $tag->getLastEvent();
        }
        $query .= ' upsert where name = "%tagName%"';

        $this->database->command(strtr($query, $data));
    }
}

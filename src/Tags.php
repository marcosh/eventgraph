<?php

namespace Marcosh\EventGraph;

class Tags
{
    // private $database;

    // public function __construct($database)
    // {
    //     $this->database = $database;
    // }

    // /**
    //  * @param string
    //  * @return Tag
    //  */
    // public function createTag($tagName)
    // {
    //     $tag = new Tag();
    //     $tag->setName($tagName);

    //     return $tag;
    // }

    // /**
    //  * @param object record coming from the database
    //  * @return Tag
    //  */
    // private function createFromData(\PhpOrient\Protocols\Binary\Data\Record $record)
    // {
    //     $data = $record->getOData();

    //     $tag = new Tag();
    //     $tag->setId($record->getRid())
    //         ->setName($data['name']);
    //     if (isset($data['first'])) {
    //         $tag->setFirstEvent($data['first']);
    //     }
    //     if (isset($data['last'])) {
    //         $tag->setLastEvent($data['last']);
    //     }
    //     return $tag;
    // }

    // /**
    //  * @param string
    //  * @return Tag
    //  */
    // public function getTag($tagName)
    // {
    //     $query = 'select from Tag where name = "%tagName%"';
    //     $data = array('%tagName%' => $tagName);
    //     $tagData = $this->database->query(strtr($query, $data));
    //     return $this->createFromData($tagData[0]);
    // }

    // /**
    //  * @param Tag
    //  * @return string tag id
    //  */
    // public function saveTag($tag)
    // {
    //     if ($tag->getId()) {
    //         return $this->updateTag($tag);
    //     }

    //     return $this->insertTag($tag);
    // }

    // /**
    //  * @param Tag
    //  * @return string tag id
    //  */
    // private function insertTag($tag)
    // {
    //     $query = 'insert into Tag set name = "%name%"';
    //     $data = ['%tagName%' => $tag->getName()];

    //     if ($tag->getFirstEvent()) {
    //         $query .= ', first = %first%';
    //         $data['%first%'] = $tag->getFirstEvent();
    //     }

    //     if ($tag->getLastEvent()) {
    //         $query .= ', last = %last%';
    //         $data['%last%'] = $tag->getLastEvent();
    //     }

    //     $this->database->command(strtr($query, $data));

    //     return $this->database->lastInsertedId();
    // }

    // /**
    //  * @param Tag
    //  * @return string tag id
    //  */
    // private function updateTag($tag)
    // {
    //     $query = 'update %id% set name = "%name%"';
    //     $data = ['%id%' => $tag->getId()];

    //     if ($tag->getFirstEvent()) {
    //         $query .= ', first = %first%';
    //         $data['%first%'] = $tag->getFirstEvent();
    //     }

    //     if ($tag->getLastEvent()) {
    //         $query .= ', last = %last%';
    //         $data['%last%'] = $tag->getLastEvent();
    //     }

    //     $this->database->command(strtr($query, $data));

    //     return $tag->getId();
    // }
}

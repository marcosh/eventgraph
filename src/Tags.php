<?php

namespace Marcosh\EventGraph;

class Tags
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
}

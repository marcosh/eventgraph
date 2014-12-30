<?php

namespace Marcosh\Eventgraph;

class Events
{
    private $database;

    public function __construct($database)
    {
        $this->database = $database;
    }
}

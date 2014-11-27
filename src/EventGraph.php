<?php

namespace Marcosh\EventGraph;

use OrientDB\Client;

class EventGraph
{
    private $database;

    public function connect(array $config)
    {
        $databaseName = $config['name'];
        unset($config['name']);

        $client = new Client($config);

        $this->database = $client->getDatabase($databaseName, true);
    }

    public function createEvent()
    {
        return true;
    }
}

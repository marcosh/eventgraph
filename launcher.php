<?php

use PhpOrient\PhpOrient;
use Marcosh\EventGraph\EventGraph;

require __DIR__.'/vendor/autoload.php';

$config = [
    'hostname' => 'localhost',
    'port' => 2424,
    'username' => 'root',
    'password' => 'password'
];
$client = new PhpOrient();
$client->configure($config);
$eventGraph = new EventGraph($client, 'mydb');

var_dump($eventGraph->getTagHistory('tag'));

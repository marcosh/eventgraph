<?php

namespace Marcosh\EventGraph;

use Marcosh\EventGraph\EventGraph;

class EventGraphTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateEvent()
    {
        $eventGraph = new EventGraph();
        $this->assertTrue($eventGraph->createEvent());
    }
}

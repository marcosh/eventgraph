<?php

namespace Marcosh\EventGraph;

class TagTest extends \PHPUnit_Framework_TestCase
{
    public function testTagWithNoHistoryHasNullFirstEvent()
    {
        $tag = new Tag();
        $this->assertNull($tag->getFirstEvent());
    }

    public function testTagWithNoHistoryHasNullLastEvent()
    {
        $tag = new Tag();
        $this->assertNull($tag->getLastEvent());
    }
}

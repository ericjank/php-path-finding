<?php

use \KISS\PathFinding\{Vertex, Implementations\InRAM\InRAMPathStep};

/**
 * Description of InRAMPathStepTest
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
class InRAMPathStepTest extends PHPUnit_Framework_TestCase
{
    public function testGetters()
    {
        $distance = 10;
        $previousVertex = $this->getMockForAbstractClass(Vertex::class);
        $step = new InRAMPathStep($previousVertex, $distance);
        $this->assertEquals($previousVertex->getId(), $step->getPreviousVertex()->getId());
        $this->assertEquals($distance, $step->getDistanceToStart());
    }
}

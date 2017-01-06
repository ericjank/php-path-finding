<?php

namespace KISS\PathFinding\Tests\Implementations\InRAM;

use \KISS\PathFinding\{
    Tests\EdgeTestCase,
    Edge,
    Vertex,
    Implementations\InRAM\InRAMEdge
};

/**
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
class InRAMEdgeTest extends EdgeTestCase
{
    protected function getEdgeInstance(Vertex $vertexA, Vertex $vertexB, float $weight): Edge
    {
        return new InRAMEdge($vertexA, $vertexB, $weight);
    }
}

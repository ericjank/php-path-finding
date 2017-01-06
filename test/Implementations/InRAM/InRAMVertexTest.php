<?php

namespace KISS\PathFinding\Tests\Implementations\InRAM;

use \KISS\PathFinding\{
    Tests\VertexTestCase,
    Vertex,
    Implementations\InRAM\InRAMVertex
};

/**
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
class InRAMVertexTest extends VertexTestCase
{
    protected function getVertexInstance($vertexId): Vertex
    {
        return new InRAMVertex($vertexId);
    }
}

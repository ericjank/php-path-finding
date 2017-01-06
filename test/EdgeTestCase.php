<?php

namespace KISS\PathFinding\Tests;

use \KISS\PathFinding\{
    Vertex,
    Edge,
    Exceptions\UnknownVertexException
};

/**
 * Description of RAMEdgeTest
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
abstract class EdgeTestCase extends \PHPUnit_Framework_TestCase
{
    private $vertexA;
    
    private $vertexB;
    
    private $weight = 9;
    
    private $edge;
    
    abstract protected function getEdgeInstance(Vertex $vertexA, Vertex $vertexB, float $weight) : Edge;
    
    public function setUp()
    {
        parent::setUp();
        
        $this->vertexA = $this->getMockForAbstractClass(Vertex::class);
        $this->vertexA->method('getId')->willReturn('a');
        $this->vertexB = $this->getMockForAbstractClass(Vertex::class);
        $this->vertexB->method('getId')->willReturn('b');
        $this->edge = $this->getEdgeInstance($this->vertexA, $this->vertexB, $this->weight);
    }
    
    public function testGetDistance()
    {
        $this->assertEquals($this->weight, $this->edge->getDistance());
    }
    
    public function testGetOtherVertex()
    {
        $this->assertEquals($this->vertexA->getId(), $this->edge->getOtherVertex($this->vertexB)->getId());
        $this->assertEquals($this->vertexB->getId(), $this->edge->getOtherVertex($this->vertexA)->getId());
    }
    
    public function testExceptionOnUnknownVertex()
    {
        $this->expectException(UnknownVertexException::class);
        $v = $this->getMockForAbstractClass(Vertex::class);
        $v->method('getId')->willReturn('v');
        $this->edge->getOtherVertex($v);
    }
}

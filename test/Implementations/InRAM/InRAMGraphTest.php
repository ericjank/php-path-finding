<?php

use \KISS\PathFinding\{
    Vertex,
    Exceptions\UnknownVertexException,
    Implementations\InRAM\InRAMGraph
};

/**
 * Description of InRAMGraphTest
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
class InRAMGraphTest extends PHPUnit_Framework_TestCase
{
    private $map = [
        'a' => ['b' => 7, 'o' => 9, 'd' => 14],
        'b' => ['o' => 10, 'c' => 15],
        'c' => ['o' => 11, 't' => 6],
        'd' => ['o' => 2, 't' => 20]
    ];
    
    private $graph;
    
    public function setUp()
    {
        parent::setUp();
        $this->graph = new InRAMGraph($this->map);
    }
    
    public function testExceptionOnUnknowVertexId()
    {
        $this->expectException(UnknownVertexException::class);
        $this->graph->getVertexById('asd');
    }
    
    public function testGetVertexById()
    {
        $vertex = $this->graph->getVertexById('a');
        $this->assertEquals('a', $vertex->getId(), 'Wrong vertex returned');
    }
    
    public function testExceptionOnGettingUnknownVertexEdges()
    {
        $vertex = $this->getMockForAbstractClass(Vertex::class);
        $this->expectException(UnknownVertexException::class);
        $this->graph->getVertexEdgesWithUnwalkedNeighbours($vertex);
    }
        
    public function testGraphParsing()
    {
        $expected = [
            'a' => ['b' => 7, 'o' => 9, 'd' => 14],
            'b' => ['a' => 7, 'o' => 10, 'c' => 15],
            'c' => ['b' => 15, 'o' => 11, 't' => 6],
            'd' => ['a' => 14, 'o' => 2, 't' => 20],
            'o' => ['a' => 9, 'b' => 10, 'c' => 11, 'd' => 2],
            't' => ['c' => 6, 'd' => 20]
        ];
        foreach ($expected as $vertexId => $edgesData) {
            $vertex = $this->graph->getVertexById($vertexId);
            $edges = $this->graph->getVertexEdgesWithUnwalkedNeighbours($vertex);
            foreach ($edges as $edge) {
                $otherVertexId = $edge->getOtherVertex($vertex)->getId();
                $this->assertArrayHasKey($otherVertexId, $edgesData, 'Missing vertex');
                $this->assertEquals($edgesData[$otherVertexId], $edge->getDistance(), 'Wrong edge distance');
            }
        }
    }
    
    public function testReturningUnwalkedVertices()
    {
        $vertexA = $this->graph->getVertexById('a');
        $this->graph->getVertexById('b')->visit();
        $edges = $this->graph->getVertexEdgesWithUnwalkedNeighbours($vertexA);
        $hasO = false;
        $hasD = false;
        $count = 0;
        foreach ($edges as $edge) {
            $other = $edge->getOtherVertex($vertexA);
            if ($other->getId() == 'o') {
                $hasO = true;
            }
            if ($other->getId() == 'd') {
                $hasD = true;
            }
            $count++;
        }
        $this->assertEquals(2, $count, 'Wrong number of edges returned');
        $this->assertTrue($hasD, 'Node d not returned');
        $this->assertTrue($hasO, 'Node o not returned');
    }
    
}

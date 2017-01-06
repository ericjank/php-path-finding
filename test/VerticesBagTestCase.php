<?php

namespace KISS\PathFinding\Tests;

use \KISS\PathFinding\{
    Vertex,
    VerticesBag,
    Exceptions\AddingVertexWithNoDistanceException,
    Exceptions\AddingVisitedVertexException,
    Exceptions\BagIsEmptyException    
};

/**
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
abstract class VerticesBagTestCase extends \PHPUnit_Framework_TestCase
{
    private $bag;
    
    protected abstract function getVerticesBagInstance() : VerticesBag;

    public function setUp()
    {
        parent::setUp();
        $this->bag = $this->getVerticesBagInstance();
    }
    
    public function testExceptionOnAddingVisitedVertex()
    {
        $this->expectException(AddingVisitedVertexException::class);
        $vertex = $this->buildVertexWithMethodsAndValues(['isVisited' => true]);
        $this->bag->add($vertex);
    }
    
    public function testExceptionOnAddingVertexWithNoPathStep()
    {
        $this->expectException(AddingVertexWithNoDistanceException::class);
        $vertex = $this->buildVertexWithMethodsAndValues(['hasDistanceFromStartSet' => false]);
        $this->bag->add($vertex);
    }
    
    public function testIsEmpty()
    {
        $this->assertTrue($this->bag->isEmpty(), 'Bag says it is not empty when it is');
        $this->bag->add($this->buildAddableVertex());
        $this->assertFalse($this->bag->isEmpty(), 'Bag says it is empty when it is not');
    }
    
    public function testExceptionOnPullingFromEmptyBag()
    {
        $this->expectException(BagIsEmptyException::class);
        $this->bag->pullWithLowestDistanceToStart();
    }
    
    /**
     * @depends testIsEmpty
     */
    public function testPullWithLowestDistanceToStart()
    {
        $distances = [5, 8, 10, 6, 2, 8, 9];
        $expectedVertices = [];
        foreach ($distances as $distance) {
            $vertex = $this->buildVertexWithDistance($distance);
            $expectedVertices[] = $vertex;
            $this->bag->add($vertex);
        }
        usort($expectedVertices, function(Vertex $a, Vertex $b) {
            return $a->getDistanceFromStart() <=> $b->getDistanceFromStart();
        });
        $actualVertices = [];
        while (!$this->bag->isEmpty()) {
            $actualVertices[] = $this->bag->pullWithLowestDistanceToStart();
        }
        $this->assertCount(count($expectedVertices), $actualVertices, 'Number of returned vertices is not right');
        foreach ($expectedVertices as $idx => $expectedVertex) {
            $this->assertEquals(
                $expectedVertex->getId(),
                $actualVertices[$idx]->getId(),
                "Vertices at index $idx do not match"
            );
        }
    }


    private function buildVertexWithDistance($distance) : Vertex
    {
        $vertex = $this->buildAddableVertex();
        $vertex->method('getDistanceFromStart')->willReturn($distance);
        return $vertex;
    }
    
    private function buildAddableVertex()
    {
        return $this->buildVertexWithMethodsAndValues(['isVisited' => false, 'hasDistanceFromStartSet' => true]);
    }
    
    private function buildVertexWithMethodsAndValues(array $methodsAndValues) : Vertex
    {
        $vertex = $this->getMockForAbstractClass(Vertex::class);
        foreach ($methodsAndValues as $method => $value) {
            $vertex->method($method)->willReturn($value);
        }
        return $vertex;
    }
}

<?php


use \KISS\PathFinding\{
    Vertex,
    PathStep,
    Exceptions\AddingVertexWithNoDistanceException,
    Exceptions\AddingWalkedVertexException,
    Exceptions\BagIsEmptyException,
    Implementations\InRAM\InRAMVerticesBag
};

/**
 * Description of InRAMVertexesBag
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
class InRAMVerticesBagTest extends PHPUnit_Framework_TestCase
{
    private $bag;
    
    public function setUp()
    {
        parent::setUp();
        $this->bag = new InRAMVerticesBag();
    }
    
    public function testExceptionOnAddingWalkedVertex()
    {
        $this->expectException(AddingWalkedVertexException::class);
        $vertex = $this->buildVertexWithMethodsAndValues(['isWalked' => true]);
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
        $expectedVertexes = [];
        foreach ($distances as $distance) {
            $vertex = $this->buildVertexWithDistance($distance);
            $expectedVertexes[] = $vertex;
            $this->bag->add($vertex);
        }
        usort($expectedVertexes, function(Vertex $a, Vertex $b) {
            return $a->getDistanceFromStart() <=> $b->getDistanceFromStart();
        });
        $actualVertexes = [];
        while (!$this->bag->isEmpty()) {
            $actualVertexes[] = $this->bag->pullWithLowestDistanceToStart();
        }
        $this->assertCount(count($expectedVertexes), $actualVertexes, 'Number of returned vertexes is not right');
        foreach ($expectedVertexes as $idx => $expectedVertex) {
            $this->assertEquals(
                $expectedVertex->getId(),
                $actualVertexes[$idx]->getId(),
                "Vertexes at index $idx do not match"
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
        return $this->buildVertexWithMethodsAndValues(['isWalked' => false, 'hasDistanceFromStartSet' => true]);
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

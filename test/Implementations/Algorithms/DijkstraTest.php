<?php

use \KISS\PathFinding\Implementations\{
    InRAM\InRAMVertexesBag,
    InRAM\InRAMGraph,
    Algorithms\Dijkstra
};

/**
 * Description of DijkstraTest
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
class DijkstraTest extends PHPUnit_Framework_TestCase
{
    private $map = [
        'a' => ['b' => 7, 'o' => 9, 'd' => 14],
        'b' => ['o' => 10, 'c' => 15],
        'c' => ['o' => 11, 't' => 6],
        'd' => ['o' => 2, 't' => 20],
        'y' => ['z' => 3]
    ];
    
    private $bag;
    
    private $graph;
    
    private $finder;
    
    public function setUp()
    {
        parent::setUp();
        $this->bag = new InRAMVertexesBag();
        $this->graph = new InRAMGraph($this->map);
        $this->finder = new Dijkstra($this->graph, $this->bag);
    }
    
    public function testFindBetween()
    {
        $this->checkPath('a', 't', ['a', 'o', 'c', 't']);
    }
    
    public function testFromStartToStart()
    {
        $this->checkPath('a', 'a', ['a']);
    }
    
    public function testNoPath()
    {
        $this->checkPath('a', 'z', []);
    }
    
    private function checkPath($start, $end, $expected)
    {
        $path = $this->finder->findBetween($start, $end);
        $actual = [];
        foreach ($path as $vertex) {
            $actual[] = $vertex->getId();
        }
        $this->assertEquals($expected, $actual);
    }
}

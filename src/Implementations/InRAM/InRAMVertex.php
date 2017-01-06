<?php

namespace KISS\PathFinding\Implementations\InRAM;

use \KISS\PathFinding\{
    Vertex,
    Exceptions\NoDistanceFromStartSetException
};

/**
 * Description of InRAMVertex
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
class InRAMVertex implements Vertex
{
    private $id;
    
    private $distanceFromStart;
    
    private $vertexToStart;
    
    private $isVisited = false;
    
    public function __construct($id)
    {
        $this->id = $id;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getDistanceFromStart(): float
    {
        $this->throwExceptionIfNoDistanceSet();
        return $this->distanceFromStart;
    }

    public function getVertexToStart(): Vertex
    {
        $this->throwExceptionIfNoDistanceSet();
        return $this->vertexToStart;
    }

    public function hasDistanceFromStartSet(): bool
    {
        return isset ($this->distanceFromStart);
    }

    public function setDistanceFromStartThroughVertex(float $distance, Vertex $throughVertex)
    {
        $this->distanceFromStart = $distance;
        $this->vertexToStart = $throughVertex;
    }

    public function isVisited(): bool
    {
        return $this->isVisited;
    }

    public function visit()
    {
        $this->isVisited = true;
    }
    
    private function throwExceptionIfNoDistanceSet()
    {
        if (!$this->hasDistanceFromStartSet()) {
            throw new NoDistanceFromStartSetException('No distance from start has been set');
        }
    }
}

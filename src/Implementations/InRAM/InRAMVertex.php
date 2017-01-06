<?php

namespace KISS\PathFinding\Implementations\InRAM;

use \KISS\PathFinding\{
    Vertex,
    PathStep,
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
    
    private $isWalked = false;
    
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

    public function isWalked(): bool
    {
        return $this->isWalked;
    }

    public function markAsWalked()
    {
        $this->isWalked = true;
    }
    
    private function throwExceptionIfNoDistanceSet()
    {
        if (!$this->hasDistanceFromStartSet()) {
            throw new NoDistanceFromStartSetException('No distance from start has been set');
        }
    }
}

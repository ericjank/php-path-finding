<?php

namespace KISS\PathFinding\Implementations\InRAM;

use \KISS\PathFinding\{
    Edge,
    Vertex,
    Exceptions\UnknownVertexException
};

/**
 * A simple implementation of Edge in a weighted graph designed to reside in RAM
 * 
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
class InRAMEdge implements Edge
{
    
    private $va;
    
    private $vb;
    
    private $weight;
    
    /**
     * @param Vertex $va A vertex connected to the edge
     * @param Vertex $vb Another vertex connected to the edge
     * @param float $weight The weight (distance) of the edge
     */
    public function __construct(Vertex $va, Vertex $vb, float $weight)
    {
        $this->va = $va;
        $this->vb = $vb;
        $this->weight = $weight;
    }

    public function getDistance() : float
    {
        return $this->weight;
    }
    
    public function getOtherVertex(Vertex $v) : Vertex
    {
        if ($v->getId() == $this->va->getId()) {
            return $this->vb;
        }
        if ($v->getId() == $this->vb->getId()) {
            return $this->va;
        }
        throw new UnknownVertexException('This vertex does not belong to this edge');
    }
    
}

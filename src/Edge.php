<?php

namespace KISS\PathFinding;

/**
 * Represents an edge in a weighted graph
 * 
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
interface Edge
{
    /**
     * Returns the weight of the edge.
     * Because, the interface is meant to be used
     * in the context of path-finding, the weight is called distance.
     */
    public function getDistance() : float;
    
    /**
     * Returns the vertex connected to this edge
     * which is not the one passed as a parameter.
     * 
     * @param \KISS\PathFinding\Vertex $v One of the vertices of the edge
     * @throws \KISS\PathFinding\Exceptions\UnknownVertexException When $v is not connected the this edge
     */
    public function getOtherVertex(Vertex $v) : Vertex;
}

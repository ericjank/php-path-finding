<?php

namespace KISS\PathFinding;

/**
 * Represents a collection of vertices which are queueed for visitation during path finding
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
interface VerticesBag
{
    /**
     * @throws \KISS\PathFinding\Exceptions\AddingVertexWithNoDistanceException
     * @throws \KISS\PathFinding\Exceptions\AddingVisitedVertexException
     */
    public function add(Vertex $v);
    
    public function isEmpty() : bool;
    
    /**
     * Removes from the bag and returns the vertex with distance closest to start
     * @throws KISS\PathFinding\Exceptions\BagIsEmptyException
     */
    public function pullWithLowestDistanceToStart() : Vertex;
}

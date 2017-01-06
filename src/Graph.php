<?php

namespace KISS\PathFinding;

/**
 * Represents a weighted graph.
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
interface Graph
{
    /**
     * @param mixed $id
     * @throws \KISS\PathFinding\Exceptions\UnknownVertexException
     */
    public function getVertexById($id) : Vertex;
    
    /**
     * Returns the edges connected to $vertex that have unvisited vertices on the other end
     * 
     * @param \KISS\PathFinding\Vertex $vertex
     * @return \KISS\PathFinding\Vertex\Edge[]
     * @throws \KISS\PathFinding\Exceptions\UnknownVertexException when $vertex is not found in the graph
     */
    public function getVertexEdgesWithUnvisitedNeighbours(Vertex $vertex) : \Iterator;
}

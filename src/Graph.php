<?php

namespace KISS\PathFinding;

/**
 * Description of Graph
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
interface Graph
{
    public function getVertexById($id) : Vertex;
    
    /**
     * @param \KISS\PathFinding\Vertex $vertex
     * @return \KISS\PathFinding\Vertex\Edge[]
     */
    public function getVertexEdgesWithUnwalkedNeighbours(Vertex $vertex) : \Iterator;
}

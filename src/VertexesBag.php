<?php

namespace KISS\PathFinding;

/**
 * Description of UnwalkedVertexesBag
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
interface VertexesBag
{
    public function add(Vertex $v);
    
    public function isEmpty() : bool;
    
    public function pullWithLowestDistanceToStart() : Vertex;
}

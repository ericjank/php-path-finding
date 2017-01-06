<?php

namespace KISS\PathFinding;

/**
 * Description of UnwalkedVerticesBag
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
interface VerticesBag
{
    public function add(Vertex $v);
    
    public function isEmpty() : bool;
    
    public function pullWithLowestDistanceToStart() : Vertex;
}

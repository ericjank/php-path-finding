<?php

namespace KISS\PathFinding;

/**
 * Description of Edge
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
interface Edge
{
    public function getDistance() : float;
    
    public function getOtherVertex(Vertex $v) : Vertex;
}

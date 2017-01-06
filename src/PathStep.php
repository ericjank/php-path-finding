<?php

namespace KISS\PathFinding;

/**
 * Description of Distance
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
interface PathStep
{
    public function getPreviousVertex() : Vertex;
    
    public function getDistanceToStart() : float;
}

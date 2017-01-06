<?php

namespace KISS\PathFinding\Implementations\InRAM;

use \KISS\PathFinding\{PathStep, Vertex};

/**
 * Description of InRAMPathStep
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
class InRAMPathStep implements PathStep
{
    private $previousVertex;
    
    private $distanceToStart;
    
    public function __construct($previousVertex, $distanceToStart)
    {
        $this->previousVertex = $previousVertex;
        $this->distanceToStart = $distanceToStart;
    }


    public function getDistanceToStart(): float
    {
        return $this->distanceToStart;
    }

    public function getPreviousVertex(): Vertex
    {
        return $this->previousVertex;
    }

}

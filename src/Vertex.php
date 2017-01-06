<?php

namespace KISS\PathFinding;

/**
 * Description of Vertex
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
interface Vertex
{   
    public function getId();
    
    public function setDistanceFromStartThroughVertex(float $distance, Vertex $throughVertex);
    
    public function hasDistanceFromStartSet() : bool;
    
    public function getDistanceFromStart() : float;
    
    public function getVertexToStart() : Vertex;
    
    public function markAsWalked();
    
    public function isWalked() : bool;
}

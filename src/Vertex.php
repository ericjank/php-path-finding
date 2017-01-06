<?php

namespace KISS\PathFinding;

/**
 * Represents a vertex in a wegheted graph in which path finding is to take place
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
interface Vertex
{   
    /**
     * Returns the id if this vertex
     * @return mixed
     */
    public function getId();
    
    /**
     * Sets a distance to the start vertex and a neighboring vertex through which this distance is achieved
     * @param float $distance
     * @param \KISS\PathFinding\Vertex $throughVertex
     */
    public function setDistanceFromStartThroughVertex(float $distance, Vertex $throughVertex);
    
    /**
     * Tells wether a distance from the start has been set
     */
    public function hasDistanceFromStartSet() : bool;
    
    /**
     * Returns the distance from the start which had been set
     * @throws KISS\PathFinding\Exceptions\NoDistanceFromStartSetException
     */
    public function getDistanceFromStart() : float;
    
    /**
     * Returns the vertex through which the set distance to start is achieved
     * @throws KISS\PathFinding\Exceptions\NoDistanceFromStartSetException
     */
    public function getVertexToStart() : Vertex;
    
    /**
     * Marks this vertex as visited
     */
    public function visit();
    
    /**
     * Tells wether this vertex has been marked as visited
     */
    public function isVisited() : bool;
}

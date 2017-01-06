<?php

namespace KISS\PathFinding;

/**
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
interface ShortestPathFinder
{
    /**
     * Finds the shortest path bettwen two vertices in a weighted graph
     * @param mixed $vertexAId ID of the first vertex
     * @param mixed $vertexBId ID of the second vertex
     * @return Vertex[] An ordered array containing all the vertices building the path
     */
    public function findBetween($vertexAId, $vertexBId) : array;
}

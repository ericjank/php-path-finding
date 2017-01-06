<?php

namespace KISS\PathFinding;

/**
 * Description of PathFinder
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
interface ShortestPathFinder
{
    public function findBetween($vertexAId, $vertexBId) : array;
}

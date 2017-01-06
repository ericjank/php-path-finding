<?php

namespace KISS\PathFinding\Implementations\InRAM;

use \KISS\PathFinding\{
    Vertex,
    VertexesBag,
    Exceptions\AddingVertexWithNoDistanceException,
    Exceptions\AddingWalkedVertexException,
    Exceptions\BagIsEmptyException
};

/**
 * Description of InRAMVertexesBag
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
class InRAMVertexesBag implements VertexesBag
{
    /**
     *
     * @var Vertex[]
     */
    private $vertexes = [];
    
    public function add(Vertex $v)
    {
        if ($v->isWalked()) {
            throw new AddingWalkedVertexException('Trying to add walked vertex to vertexes bag');
        }
        if (!$v->hasDistanceFromStartSet()) {
            throw new AddingVertexWithNoDistanceException('Trying to add vertex with no path step set');
        }
        $this->vertexes[] = $v;
    }
    
    public function isEmpty() : bool
    {
        return empty ($this->vertexes);
    }

    public function popWithLowestDistanceToStart(): Vertex
    {
        if ($this->isEmpty()) {
            throw new BagIsEmptyException('The bag is empty');
        }
        $selectedIndex = -1;
        $lowestDistance = null;
        foreach ($this->vertexes as $idx => $vertex) {
            $currentDistance = $vertex->getDistanceFromStart();
            if (is_null($lowestDistance) || $lowestDistance > $currentDistance) {
                $lowestDistance = $currentDistance;
                $selectedIndex = $idx;
            }
        }
        return array_splice($this->vertexes, $selectedIndex, 1)[0];
    }
}

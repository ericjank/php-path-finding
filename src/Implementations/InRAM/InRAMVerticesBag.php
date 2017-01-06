<?php

namespace KISS\PathFinding\Implementations\InRAM;

use \KISS\PathFinding\{
    Vertex,
    VerticesBag,
    Exceptions\AddingVertexWithNoDistanceException,
    Exceptions\AddingWalkedVertexException,
    Exceptions\BagIsEmptyException
};

/**
 * Description of InRAMVerticesBag
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
class InRAMVerticesBag implements VerticesBag
{
    /**
     *
     * @var Vertex[]
     */
    private $vertices = [];
    
    public function add(Vertex $v)
    {
        if ($v->isWalked()) {
            throw new AddingWalkedVertexException('Trying to add walked vertex to vertices bag');
        }
        if (!$v->hasDistanceFromStartSet()) {
            throw new AddingVertexWithNoDistanceException('Trying to add vertex with no path step set');
        }
        $this->vertices[] = $v;
    }
    
    public function isEmpty() : bool
    {
        return empty ($this->vertices);
    }

    public function pullWithLowestDistanceToStart(): Vertex
    {
        if ($this->isEmpty()) {
            throw new BagIsEmptyException('The bag is empty');
        }
        $selectedIndex = -1;
        $lowestDistance = null;
        foreach ($this->vertices as $idx => $vertex) {
            $currentDistance = $vertex->getDistanceFromStart();
            if (is_null($lowestDistance) || $lowestDistance > $currentDistance) {
                $lowestDistance = $currentDistance;
                $selectedIndex = $idx;
            }
        }
        return array_splice($this->vertices, $selectedIndex, 1)[0];
    }
}

<?php

namespace KISS\PathFinding\Implementations\Algorithms;

use \KISS\PathFinding\{
    Graph,
    Edge,
    Vertex,
    VerticesBag,
    ShortestPathFinder
};

/**
 * Description of Dijkstra
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
class Dijkstra implements ShortestPathFinder
{
    
    private $graph;
    
    private $bag;
    
    public function __construct(Graph $graph, VerticesBag $bag)
    {
        $this->graph = $graph;
        $this->bag = $bag;
    }

    public function findBetween($startId, $endId): array
    {
        $vStart = $this->graph->getVertexById($startId);
        $vStart->setDistanceFromStartThroughVertex(0, $vStart);
        $this->bag->add($vStart);
        
        do {
            $current = $this->bag->pullWithLowestDistanceToStart();
            $foundPath = $current->getId() == $endId;
            if ($foundPath) {
                break;
            }
            $currentDistance = $current->getDistanceFromStart();
            $edges = $this->graph->getVertexEdgesWithUnwalkedNeighbours($current);
            foreach ($edges as $edge) {
                $other = $edge->getOtherVertex($current);
                $hadDistanceSet = $other->hasDistanceFromStartSet();
                $newDistance = $currentDistance + $edge->getDistance();
                if (!$hadDistanceSet || $other->getDistanceFromStart() > $newDistance) {
                    $other->setDistanceFromStartThroughVertex($newDistance, $current);
                }
                if (!$hadDistanceSet) {
                    $this->bag->add($other);
                }
            }
        } while (!$this->bag->isEmpty());
        
        if (!$foundPath) {
            return [];
        }
        
        $result = [];
        while ($current->getId() != $vStart->getId()) {
            $result[] = $current;
            $current = $current->getVertexToStart();
        }
        $result[] = $vStart;
        return array_reverse($result);
    }
}

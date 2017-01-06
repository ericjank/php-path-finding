<?php

namespace KISS\PathFinding\Implementations\InRAM;

use \KISS\PathFinding\{
    Graph,
    Vertex,
    Exceptions\UnknownVertexException
};

/**
 * Description of InRAMVertexListGraph
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
class InRAMGraph implements Graph
{
    private $graph = [];
    
    public function __construct(array $map)
    {
        foreach ($map as $vertexIdA => $edges) {
            $vertexA = $this->createVertexIfNotExists($vertexIdA);
            foreach ($edges as $vertexIdB => $edgeDistance) {
                $vertexB = $this->createVertexIfNotExists($vertexIdB);
                $edge = new InRAMEdge($vertexA, $vertexB, $edgeDistance);
                $this->graph[$vertexIdA]['edges'][] = $edge;
                $this->graph[$vertexIdB]['edges'][] = $edge;
            }
        }
    }
    
    public function getVertexById($id): Vertex
    {
        $this->throwExceptionIfIdNotKnown($id);
        return $this->graph[$id]['vertex'];
    }

    public function getVertexEdgesWithUnwalkedNeighbours(Vertex $vertex): \Iterator
    {
        $this->throwExceptionIfIdNotKnown($vertex->getId());
        return call_user_func(function() use ($vertex) {
            foreach ($this->graph[$vertex->getId()]['edges'] as $edge) {
                $other = $edge->getOtherVertex($vertex);
                if (!$other->isVisited()) {
                    yield $edge;
                }
            }
        });
    }
    
    private function createVertexIfNotExists($vertexId) : InRAMVertex
    {
        if (!isset ($this->graph[$vertexId])) {
            $this->graph[$vertexId] = ['vertex' => new InRAMVertex($vertexId), 'edges' => []];
        }
        return $this->graph[$vertexId]['vertex'];
    }
    
    private function throwExceptionIfIdNotKnown($id)
    {
        if (!isset ($this->graph[$id])) {
            throw new UnknownVertexException('No such vertex in graph');
        }
    }
}

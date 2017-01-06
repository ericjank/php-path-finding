<?php

namespace KISS\PathFinding\Tests\Implementations\InRAM;

use \KISS\PathFinding\{
    Graph,
    Tests\GraphTestCase,
    Implementations\InRAM\InRAMGraph
};

/**
 * Description of InRAMGraphTest
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
class InRAMGraphTest extends GraphTestCase
{
    protected function getGraphInstance(array $map): Graph
    {
        return new InRAMGraph($map);
    }
}

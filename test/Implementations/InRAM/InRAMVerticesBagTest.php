<?php

namespace KISS\PathFinding\Tests\Implementations\InRAM;

use \KISS\PathFinding\{
    VerticesBag,
    Implementations\InRAM\InRAMVerticesBag,
    Tests\VerticesBagTestCase
};

/**
 * Description of InRAMVerticesBagTest
 *
 * @author Milko Kosturkov<mkosturkov@gmail.com>
 */
class InRAMVerticesBagTest extends VerticesBagTestCase
{
    protected function getVerticesBagInstance(): VerticesBag
    {
        return new InRAMVerticesBag();
    }
}

<?php
/**
 * This file is part of the Axstrad library.
 *
 * (c) Dan Kempster <dev@dankempster.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2014-2015 Dan Kempster <dev@dankempster.co.uk>
 */

namespace Axstrad\Component\WorkForce\Tests\Unit\Report;

use Axstrad\Component\Test\TestCase;
use Axstrad\Component\WorkForce\Report\NoAbleWorkersReport;
use Axstrad\Component\WorkForce\Report;
use PhpOption\None;

/**
 * @group unit
 */
class NoAbleWorkersReportTest extends TestCase
{
    public function setUp()
    {
        $this->fixture = new NoAbleWorkersReport;
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\NoAbleWorkersReport::getState
     */
    public function testGetState()
    {
        $this->assertEquals(
            Report::STATUS_NO_WORKERS,
            $this->fixture->getState()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\NoAbleWorkersReport::wasWorked
     */
    public function testWasWorked()
    {
        $this->assertFalse($this->fixture->wasWorked());
    }
}

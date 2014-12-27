<?php
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

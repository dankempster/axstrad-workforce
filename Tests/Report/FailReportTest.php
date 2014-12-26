<?php
namespace Axstrad\Component\WorkForce\Tests\Report;

use Axstrad\Component\Test\TestCase;
use Axstrad\Component\WorkForce\Report\FailReport;
use Axstrad\Component\WorkForce\Report;
use PhpOption\None;

class FailReportTest extends TestCase
{
    public function setUp()
    {
        $this->fixture = new FailReport;
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\FailReport::getState
     */
    public function testGetState()
    {
        $this->assertEquals(
            Report::STATUS_FAIL,
            $this->fixture->getState()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\FailReport::wasWorked
     */
    public function testWasWorked()
    {
        $this->assertTrue($this->fixture->wasWorked());
    }
}

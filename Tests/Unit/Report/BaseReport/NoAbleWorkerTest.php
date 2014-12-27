<?php
namespace Axstrad\Component\WorkForce\Tests\Unit\Report\BaseReport;

use Axstrad\Component\Test\TestCase;
use Axstrad\Component\WorkForce\Tests\Report\BaseReportTestClass;
use Axstrad\Component\WorkForce\Report;
use PhpOption\None;

/**
 * @group unit
 * @uses Axstrad\Component\WorkForce\Tests\Report\BaseReportTestClass
 */
class NoAbleWorkerTest extends TestCase
{
    protected $mockResult;

    public function setUp()
    {
        $this->mockResult = None::create();

        $this->fixture = new BaseReportTestClass;
        $this->fixture->setState(Report::STATUS_NO_WORKERS);
        $this->fixture->setResult($this->mockResult);
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\BaseReport::getState
     */
    public function testGetState()
    {
        $this->assertEquals(
            Report::STATUS_NO_WORKERS,
            $this->fixture->getState()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\BaseReport::getResult
     */
    public function testGetResult()
    {
        $this->assertSame(
            $this->mockResult,
            $this->fixture->getResult()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\BaseReport::isSuccessful
     * @depends testGetResult
     * @uses Axstrad\Component\WorkForce\Report\BaseReport::getState
     */
    public function testIsNotSuccessful()
    {
        $this->assertFalse($this->fixture->isSuccessful());
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\BaseReport::isFailure
     * @depends testGetResult
     * @depends testIsNotSuccessful
     * @uses Axstrad\Component\WorkForce\Report\BaseReport::getState
     * @uses Axstrad\Component\WorkForce\Report\BaseReport::isSuccessful
     */
    public function testIsFailure()
    {
        $this->assertTrue($this->fixture->isFailure());
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\BaseReport::hasResult
     * @depends testGetResult
     * @uses Axstrad\Component\WorkForce\Report\BaseReport::getResult
     */
    public function testDoesNotHaveResult()
    {
        $this->assertFalse($this->fixture->hasResult());
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\BaseReport::wasWorked
     * @depends testGetResult
     * @uses Axstrad\Component\WorkForce\Report\BaseReport::getState
     */
    public function testWasWorked()
    {
        $this->assertFalse($this->fixture->wasWorked());
    }
}

<?php
namespace Axstrad\Component\WorkForce\Tests\Unit\Report\BaseReport;

use Axstrad\Component\Test\TestCase;
use Axstrad\Component\WorkForce\Tests\Report\BaseReportTestClass;
use Axstrad\Component\WorkForce\Report;
use PhpOption\Some;

/**
 * @group unit
 * @uses Axstrad\Component\WorkForce\Tests\Report\BaseReportTestClass
 */
class SuccessTest extends TestCase
{
    protected $mockResult;

    public function setUp()
    {
        $this->mockResult = new Some("result");

        $this->fixture = new BaseReportTestClass;
        $this->fixture->setState(Report::STATUS_SUCCESS);
        $this->fixture->setResult($this->mockResult);
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\BaseReport::getState
     */
    public function testStateIsSuccess()
    {
        $this->assertEquals(
            Report::STATUS_SUCCESS,
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
    public function testIsSuccessful()
    {
        $this->assertTrue($this->fixture->isSuccessful());
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\BaseReport::isFailure
     * @depends testGetResult
     * @depends testIsSuccessful
     * @uses Axstrad\Component\WorkForce\Report\BaseReport::getState
     * @uses Axstrad\Component\WorkForce\Report\BaseReport::isSuccessful
     */
    public function testIsNotFailure()
    {
        $this->assertFalse($this->fixture->isFailure());
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\BaseReport::hasResult
     * @depends testGetResult
     * @uses Axstrad\Component\WorkForce\Report\BaseReport::getResult
     */
    public function testHasResult()
    {
        $this->assertTrue($this->fixture->hasResult());
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\BaseReport::wasWorked
     * @depends testGetResult
     * @uses Axstrad\Component\WorkForce\Report\BaseReport::getState
     */
    public function testWasWorked()
    {
        $this->assertTrue($this->fixture->wasWorked());
    }
}

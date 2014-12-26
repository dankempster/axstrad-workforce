<?php
namespace Axstrad\Component\WorkForce\Tests\Report;

use Axstrad\Component\Test\TestCase;
use Axstrad\Component\WorkForce\Report;
use Axstrad\Component\WorkForce\Report\SuccessReport;
use PhpOption\None;
use PhpOption\Some;


class SuccessReportTest extends TestCase
{
    public function setUp()
    {
        $this->fixture = new SuccessReport();
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\SuccessReport::__construct
     */
    public function testConstructionWithNullResult()
    {
        $this->isInstanceOf(
            'PhpOption\None',
            $this->fixture->getResult()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\SuccessReport::__construct
     */
    public function testConstructionWithNoneOptionResult()
    {
        $this->fixture = new SuccessReport(None::create());
        $this->isInstanceOf(
            'PhpOption\None',
            $this->fixture->getResult()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\SuccessReport::__construct
     */
    public function testConstructionWithStringResult()
    {
        $this->fixture = new SuccessReport('result');
        $this->isInstanceOf(
            'PhpOption\Some',
            $this->fixture->getResult()
        );
        $this->assertEquals(
            'result',
            $this->fixture->getResult()->get()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\SuccessReport::__construct
     */
    public function testConstructionWithSomeOptionResult()
    {
        $this->fixture = new SuccessReport($stub = new Some('result'));
        $this->assertSame(
            $stub,
            $this->fixture->getResult()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\SuccessReport::getState
     */
    public function testGetState()
    {
        $this->assertEquals(
            Report::STATUS_SUCCESS,
            $this->fixture->getState()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\SuccessReport::isSuccessful
     */
    public function testIsSuccessful()
    {
        $this->assertTrue($this->fixture->isSuccessful());
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\SuccessReport::isFailure
     */
    public function testIsFailure()
    {
        $this->assertFalse($this->fixture->isFailure());
    }
}

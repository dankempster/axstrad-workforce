<?php
namespace Axstrad\Component\WorkForce\Tests\Report\BaseReport;

use Axstrad\Component\Test\TestCase;
use Axstrad\Component\WorkForce\Tests\Report\BaseReportTestClass;
use Axstrad\Component\WorkForce\Report;
use PhpOption\Some;

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

    public function testGetState()
    {
        $this->assertEquals(
            Report::STATUS_SUCCESS,
            $this->fixture->getState()
        );
    }

    public function testGetResult()
    {
        $this->assertSame(
            $this->mockResult,
            $this->fixture->getResult()
        );
    }

    public function testIsSuccessful()
    {
        $this->assertTrue($this->fixture->isSuccessful());
    }

    public function testIsFailure()
    {
        $this->assertFalse($this->fixture->isFailure());
    }

    public function testHasResult()
    {
        $this->assertTrue($this->fixture->hasResult());
    }

    public function testWasWorked()
    {
        $this->assertTrue($this->fixture->wasWorked());
    }
}

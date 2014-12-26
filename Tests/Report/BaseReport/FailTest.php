<?php
namespace Axstrad\Component\WorkForce\Tests\Report\BaseReport;

use Axstrad\Component\Test\TestCase;
use Axstrad\Component\WorkForce\Tests\Report\BaseReportTestClass;
use Axstrad\Component\WorkForce\Report;
use PhpOption\None;

class FailTest extends TestCase
{
    protected $mockResult;

    public function setUp()
    {
        $this->mockResult = None::create();

        $this->fixture = new BaseReportTestClass;
        $this->fixture->setState(Report::STATUS_FAIL);
        $this->fixture->setResult($this->mockResult);
    }

    public function testGetState()
    {
        $this->assertEquals(
            Report::STATUS_FAIL,
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
        $this->assertFalse($this->fixture->isSuccessful());
    }

    public function testIsFailure()
    {
        $this->assertTrue($this->fixture->isFailure());
    }

    public function testHasResult()
    {
        $this->assertFalse($this->fixture->hasResult());
    }

    public function testWasWorked()
    {
        $this->assertTrue($this->fixture->wasWorked());
    }
}

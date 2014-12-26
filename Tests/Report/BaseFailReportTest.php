<?php
namespace Axstrad\Component\WorkForce\Tests\Report;

use Axstrad\Component\Test\TestCase;
use Axstrad\Component\WorkForce\Report;
use PhpOption\None;

class BaseFailReportTest extends TestCase
{
    public function setUp()
    {
        $this->fixture = $this->getMockForAbstractClass(
            'Axstrad\Component\WorkForce\Report\BaseFailReport'
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\BaseFailReport::getResult
     */
    public function testGetResult()
    {
        $this->assertInstanceOf(
            'PhpOption\None',
            $this->fixture->getResult()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\BaseFailReport::isSuccessful
     */
    public function testIsSuccessful()
    {
        $this->assertFalse($this->fixture->isSuccessful());
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\BaseFailReport::isFailure
     */
    public function testIsFailure()
    {
        $this->assertTrue($this->fixture->isFailure());
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\BaseFailReport::hasResult
     */
    public function testHasResult()
    {
        $this->assertFalse($this->fixture->hasResult());
    }
}

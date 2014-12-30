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
use Axstrad\Component\WorkForce\Report;
use Axstrad\Component\WorkForce\Report\SuccessReport;
use PhpOption\None;
use PhpOption\Some;


/**
 * @group unit
 * @uses Axstrad\Component\WorkForce\Test\TestCase
 */
class SuccessReportTest extends TestCase
{
    public function setUp()
    {
        $this->fixture = new SuccessReport();
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\SuccessReport::__construct
     * @uses Axstrad\Component\WorkForce\Report\BaseReport::getResult
     */
    public function testConstructionWithNullResult()
    {
        $this->assertInstanceOf(
            'PhpOption\None',
            $this->fixture->getResult()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\SuccessReport::__construct
     * @uses Axstrad\Component\WorkForce\Report\BaseReport::getResult
     */
    public function testConstructionWithNoneOptionResult()
    {
        $this->fixture = new SuccessReport(None::create());
        $this->assertInstanceOf(
            'PhpOption\None',
            $this->fixture->getResult()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\SuccessReport::__construct
     * @uses Axstrad\Component\WorkForce\Report\BaseReport::getResult
     */
    public function testConstructionWithStringResult()
    {
        $this->fixture = new SuccessReport('result');
        $this->assertInstanceOf(
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
     * @uses Axstrad\Component\WorkForce\Report\BaseReport::getResult
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
     * @uses Axstrad\Component\WorkForce\Report\SuccessReport::__construct
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
     * @uses Axstrad\Component\WorkForce\Report\SuccessReport::__construct
     */
    public function testIsSuccessful()
    {
        $this->assertTrue($this->fixture->isSuccessful());
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\SuccessReport::isFailure
     * @uses Axstrad\Component\WorkForce\Report\SuccessReport::__construct
     */
    public function testIsFailure()
    {
        $this->assertFalse($this->fixture->isFailure());
    }
}

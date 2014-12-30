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
use Axstrad\Component\WorkForce\Report\Factory;


/**
 * @group unit
 * @uses Axstrad\Component\WorkForce\Report\SuccessReport
 * @uses Axstrad\Component\WorkForce\Report\FailReport
 * @uses Axstrad\Component\WorkForce\Report\NoAbleWorkersReport
 */
class FactoryTest extends TestCase
{
    public function setUp()
    {
        $this->fixture = new Factory();
    }

    /**
     * @dataProvider resultProvider
     * @covers Axstrad\Component\WorkForce\Report\Factory::createSuccessReport
     */
    public function testCreateSuccessReportMethod($result)
    {
        $this->assertInstanceOf(
            'Axstrad\Component\WorkForce\Report\SuccessReport',
            $this->fixture->createSuccessReport($result)
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\Factory::createFailReport
     */
    public function testCreateFailureReportMethod()
    {
        $this->assertInstanceOf(
            'Axstrad\Component\WorkForce\Report\FailReport',
            $this->fixture->createFailReport()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Report\Factory::createNoAbleWorkersReport
     */
    public function testCreateNoAbleWorkersReportMethod()
    {
        $this->assertInstanceOf(
            'Axstrad\Component\WorkForce\Report\NoAbleWorkersReport',
            $this->fixture->createNoAbleWorkersReport()
        );
    }

    /**
     * @dataProvider resultProvider
     * @depends testCreateSuccessReportMethod
     * @depends testCreateFailureReportMethod
     * @uses Axstrad\Component\WorkForce\Report\Factory::createSuccessReport
     * @uses Axstrad\Component\WorkForce\Report\Factory::createFailReport
     * @covers Axstrad\Component\WorkForce\Report\Factory::createFromResult
     */
    public function testCreateFromResult($result, $expected)
    {
        $this->assertInstanceOf(
            $expected,
            $this->fixture->createFromResult($result)
        );
    }

    public function resultProvider()
    {
        return array(
            array(
                new \PhpOption\Some('foo'),
                'Axstrad\Component\WorkForce\Report\SuccessReport',
            ),
            array(
                \PhpOption\None::create(),
                'Axstrad\Component\WorkForce\Report\FailReport',
            ),
            array(
                null,
                'Axstrad\Component\WorkForce\Report\FailReport',
            )
        );
    }
}

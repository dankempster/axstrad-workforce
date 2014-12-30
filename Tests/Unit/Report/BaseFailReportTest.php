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
use PhpOption\None;


/**
 * @group unit
 */
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

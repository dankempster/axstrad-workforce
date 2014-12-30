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

namespace Axstrad\Component\WorkForce\Tests\Unit\Report\BaseReport;

use Axstrad\Component\Test\TestCase;
use Axstrad\Component\WorkForce\Tests\Report\BaseReportTestClass;
use Axstrad\Component\WorkForce\Report;
use PhpOption\None;

/**
 * @group unit
 * @uses Axstrad\Component\WorkForce\Tests\Report\BaseReportTestClass
 */
class SuccessWithoutResultTest extends TestCase
{
    protected $mockResult;

    public function setUp()
    {
        $this->mockResult = None::create();

        $this->fixture = new BaseReportTestClass;
        $this->fixture->setState(Report::STATUS_SUCCESS);
        $this->fixture->setResult($this->mockResult);
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
     * @covers Axstrad\Component\WorkForce\Report\BaseReport::hasResult
     * @depends testGetResult
     * @uses Axstrad\Component\WorkForce\Report\BaseReport::getResult
     */
    public function testDoesNotHaveResult()
    {
        $this->assertFalse($this->fixture->hasResult());
    }
}

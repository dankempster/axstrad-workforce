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

namespace Axstrad\Component\WorkForce\Tests\Unit\Test;

use Axstrad\Component\WorkForce\Report;
use Axstrad\Component\WorkForce\Test\TestCase;
use PhpOption\None;
use PhpOption\Option;
use PhpOption\Some;


/**
 * @group unit
 */
class TestCaseTest extends TestCase
{
    /**
     * @covers Axstrad\Component\WorkForce\Test\TestCase::createMockReport
     * @covers Axstrad\Component\WorkForce\Test\TestCase::getLastCreatedMockReport
     * @dataProvider createMockReportDataProvider
     * @param array $setup
     * @param string $optionClass
     * @param boolean $isSuccessful
     * @param boolean $isFailure
     */
    public function testCreateMockReportMethod($setup, $optionClass, $isSuccessful, $isFailure, $wasWorked)
    {
        $mockReport = $this->createMockReport(
            $setup['status'],
            isset($setup['result']) ? $setup['result'] : null,
            isset($setup['className']) ? $setup['className'] : ''
        );

        $this->assertEquals(
            $setup['status'],
            $mockReport->getState()
        );

        $this->assertInstanceOf(
            $optionClass,
            $mockReport->getResult()
        );

        if (isset($setup['result']) && !$setup['result'] instanceof None) {
            $this->assertEquals(
                $setup['result'] instanceof Some ? $setup['result']->get() : $setup['result'],
                $mockReport->getResult()->get()
            );
        }

        if (!empty($setup['className'])) {
            $this->stringStartsWith(
                $setup['className'],
                get_class($mockReport)
            );
        }

        $this->assertEquals(
            $isSuccessful,
            $mockReport->isSuccessful()
        );

        $this->assertEquals(
            $isFailure,
            $mockReport->isFailure()
        );

        $this->assertEquals(
            $wasWorked,
            $mockReport->wasWorked()
        );

        $this->assertSame(
            $mockReport,
            $this->getLastCreatedMockReport()
        );
    }

    public function createMockReportDataProvider()
    {
        return array(
            [
                ['status' => Report::STATUS_SUCCESS],
                'PhpOption\None',
                true,
                false,
                true
            ],
            [
                [
                    'status' => Report::STATUS_SUCCESS,
                    'result' => None::create(),
                ],
                'PhpOption\None',
                true,
                false,
                true
            ],
            [
                [
                    'status' => Report::STATUS_SUCCESS,
                    'result' => 'My Result',
                ],
                'PhpOption\Some',
                true,
                false,
                true
            ],
            [
                [
                    'status' => Report::STATUS_SUCCESS,
                    'result' => Option::fromValue('My Result'),
                ],
                'PhpOption\Some',
                true,
                false,
                true
            ],
            [
                ['status' => Report::STATUS_FAIL],
                'PhpOption\None',
                false,
                true,
                true
            ],
            [
                ['status' => Report::STATUS_NO_WORKERS],
                'PhpOption\None',
                false,
                true,
                false
            ],
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Test\TestCase::createMockWorker
     */
    public function testCreateMockWorkerMethod()
    {
        $fixture = $this->createMockWorker();
        $this->assertInstanceOf(
            'Axstrad\Component\WorkForce\Worker',
            $fixture
        );
        $this->assertInstanceOf(
            'PHPUnit_Framework_MockObject_MockObject',
            $fixture
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Test\TestCase::createMockWorker
     * @depends testCreateMockWorkerMethod
     */
    public function testCanSetMockWorkersClassName()
    {
        $fixture = $this->createMockWorker('Test_Mock_Worker_ClassName');
        $this->assertEquals(
            'Test_Mock_Worker_ClassName',
            get_class($fixture)
        );
    }

    /**
     * @uses Axstrad\Component\WorkForce\Test\TestCase::createMockWorker
     * @covers Axstrad\Component\WorkForce\Test\TestCase::workerCanWork
     * @depends testCreateMockWorkerMethod
     */
    public function testWorkIsMockedToReturnTrue()
    {
        $fixture = $this->workerCanWork();
        $this->assertTrue(
            $fixture->canWork('')
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Test\TestCase::getLastCreatedMockReport
     * @covers Axstrad\Component\WorkForce\Test\TestCase::workerCanWork
     * @depends testCreateMockWorkerMethod
     * @depends testCreateMockReportMethod
     * @uses Axstrad\Component\WorkForce\Test\TestCase::createMockReport
     * @uses Axstrad\Component\WorkForce\Test\TestCase::createMockWorker
     */
    public function testCanMockWorkReturnValue()
    {
        $fixture = $this->workerCanWork('foo');
        $fixture->canWork(''); // required to satisfy method call assetion
        $this->assertSame(
            $this->getLastCreatedMockReport(),
            $fixture->work('')
        );
    }

    /**
     * @uses Axstrad\Component\WorkForce\Test\TestCase::createMockWorker
     * @covers Axstrad\Component\WorkForce\Test\TestCase::workerCannotWork
     * @depends testCreateMockWorkerMethod
     */
    public function testWorkIsMockedToReturnFalse()
    {
        $fixture = $this->workerCanNotWork();
        $this->assertFalse(
            $fixture->canWork('')
        );
    }

    /**
     * @uses Axstrad\Component\WorkForce\Test\TestCase::createMockWorker
     * @covers Axstrad\Component\WorkForce\Test\TestCase::workerIsNotUsed
     * @depends testCreateMockWorkerMethod
     */
    public function testWorkerIsNotUsedMethodAndMockObject()
    {
        $fixture = $this->workerIsNotUsed();

        // now all should pass if we don't do anything :)
    }

    /**
     *
     */
}

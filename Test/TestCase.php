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

namespace Axstrad\Component\WorkForce\Test;

use Axstrad\Component\Test\TestCase as BaseTestCase;
use Axstrad\Component\WorkForce\Report;
use PhpOption\Option;


/**
 * Axstrad\Component\WorkForce\Test\TestCase
 */
abstract class TestCase extends BaseTestCase
{
    protected function createMockWorker($mockClassName = '')
    {
        return $this->getMockForAbstractClass(
            'Axstrad\Component\WorkForce\Worker',
            array(),
            $mockClassName
        );
    }

    protected function createMockReport($status, $result = null, $mockClassName = '')
    {
        if ($mockClassName == '') {
            $mockClassName = 'Mock_Report_';
            if ($status === Report::STATUS_SUCCESS) {
                $mockClassName .= 'Success';

                if (isset($result) && !$result instanceof None) {
                    $mockClassName .= 'Result';
                }
                else {
                    $mockClassName .= 'NoResult';
                }
            }
            elseif ($status === 0) {
                $mockClassName .= 'NoWorkers';
            }
            else {
                $mockClassName .= 'Fail';
            }
        }

        $mock = $this->getMockForAbstractClass(
            'Axstrad\Component\WorkForce\Report',
            array(),
            $mockClassName
        );
        $mock
            ->expects($this->any())
            ->method('getState')
            ->will($this->returnValue($status))
        ;

        if (!$result instanceof Option) {
            $result = Option::fromValue($result);
        }
        $mock
            ->expects($this->any())
            ->method('getResult')
            ->will($this->returnValue($result))
        ;

        $mock
            ->expects($this->any())
            ->method('isSuccessful')
            ->will($this->returnValue($status == Report::STATUS_SUCCESS))
        ;
        $mock
            ->expects($this->any())
            ->method('isFailure')
            ->will($this->returnValue(($status & Report::STATE_OK) == 0))
        ;
        $mock
            ->expects($this->any())
            ->method('wasWorked')
            ->will($this->returnValue(($status & Report::STATE_WAS_WORKED) > 0))
        ;


        $this->lastCreatedReport = $mock;
        return $mock;
    }

    protected function getLastCreatedMockReport()
    {
        return $this->lastCreatedReport;
    }

    protected function workerCanWork($workResult = null)
    {
        $worker = $this->createMockWorker('Mock_Worker_DoesWork');
        $worker
            ->expects($this->once())
            ->method('canWork')
            ->will($this->returnValue(true))
        ;

        if ($workResult !== null) {
            if (!$workResult instanceof Report) {
                $mockReport = $this->createMockReport(
                    $workResult ? Report::STATUS_SUCCESS : Report::STATUS_FAIL,
                    $workResult
                );
            }

            $worker
                ->expects($this->once())
                ->method('work')
                ->will($this->returnValue($mockReport))
            ;
        }
        return $worker;
    }

    protected function workerFailsWork()
    {
        $worker = $this->createMockWorker('Mock_Worker_WorkFails');
        $worker
            ->expects($this->once())
            ->method('canWork')
            ->will($this->returnValue(true))
        ;

        $worker
            ->expects($this->once())
            ->method('work')
            ->will($this->returnValue(
                $this->createMockReport(Report::STATUS_FAIL)
            ))
        ;

        return $worker;
    }

    protected function workerCanNotWork()
    {
        $worker = $this->createMockWorker('Mock_Worker_CanNotWork');
        $worker
            ->expects($this->once())
            ->method('canWork')
            ->will($this->returnValue(false))
        ;
        return $worker;
    }

    protected function workerIsNotUsed()
    {
        $worker = $this->createMockWorker('Mock_Worker_IsNotUsed');
        $worker->expects($this->never())
            ->method('canWork')
        ;
        $worker->expects($this->never())
            ->method('work')
        ;
        return $worker;
    }

    protected function createMockFactory()
    {
        $mock = $this->getMock('Axstrad\Component\WorkForce\Report\Factory');
        $mock->expects($this->any())
            ->method('createNoAbleWorkersReport')
            ->will($this->returnValue(
                $this->createMockReport(Report::STATUS_NO_WORKERS)
            ))
        ;
        return $mock;
    }
}

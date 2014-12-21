<?php
namespace Axstrad\Component\WorkForce\Test;

use Axstrad\Component\Test\TestCase as BaseTestCase;


/**
 * Axstrad\Component\WorkForce\Test\TestCase
 */
class TestCase extends BaseTestCase
{
    protected function createMockWorker($mockClassName = '')
    {
        return $this->getMockForAbstractClass(
            'Axstrad\Component\WorkForce\Worker',
            array(),
            $mockClassName
        );
    }

    protected function workerCanWork($workResult = null)
    {
        $worker = $this->createMockWorker('Mock_Worker_CanWork');
        $worker
            ->expects($this->once())
            ->method('canWork')
            ->will($this->returnValue(true))
        ;

        if ($workResult !== null) {
            $worker
                ->expects($this->once())
                ->method('work')
                ->will($this->returnValue($workResult))
            ;
        }
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
}

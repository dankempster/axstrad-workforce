<?php
namespace Axstrad\Component\WorkForce\Tests\Unit\Team;

use Axstrad\Component\WorkForce\Team\PriorityDelegator;
use Axstrad\Component\WorkForce\Test\TeamStorageAccessor;
use Axstrad\Component\WorkForce\Test\TestCase;


/**
 * @covers Axstrad\Component\WorkForce\Team\PriorityDelegator::__construct
 * @group unit
 * @uses Axstrad\Component\WorkForce\Test\TeamStorageAccessor
 * @uses Axstrad\Component\WorkForce\Test\TestCase
 */
class PriorityDelegatorTest extends TestCase
{
    public function setUp()
    {
        $this->fixture = new PriorityDelegator();
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\PriorityDelegator::addWorker
     */
    public function testCanAddWorker()
    {
        $this->fixture->addWorker(
            $mock = $this->createMockWorker()
        );
        $this->assertAttributeContains(
            $mock,
            "workers",
            $this->fixture
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\PriorityDelegator::removeWorker
     * @depends testCanAddWorker
     * @uses Axstrad\Component\WorkForce\Team\PriorityDelegator::addWorker
     */
    public function testCanRemoveWorker()
    {
        $this->fixture->addWorker(
            $mock = $this->createMockWorker()
        );
        $this->fixture->removeWorker($mock);
        $this->assertAttributeNotContains(
            $mock,
            "workers",
            $this->fixture
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\PriorityDelegator::addWorker
     * @depends testCanAddWorker
     */
    public function testCanAddWorkerWithPriority()
    {
        $this->fixture->addWorker(
            $mock = $this->createMockWorker(),
            100
        );
        $storage = TeamStorageAccessor::getInternalStorage($this->fixture);
        $this->assertEquals(
            100,
            $storage->offsetGet($mock)
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\PriorityDelegator::getIterator
     */
    public function testUsesSplPriorityQueueForIteration()
    {
        $this->assertInstanceOf(
            'SplPriorityQueue',
            $this->fixture->getIterator()
        );
    }

    /**
     * @dataProvider workersProvider
     * @covers Axstrad\Component\WorkForce\Team\PriorityDelegator::getIterator
     * @uses Axstrad\Component\WorkForce\Team\PriorityDelegator::addWorker
     */
    public function testSplPriorityQueueContainsWorkersInPriorityOrder($workers, $expectedCanWork, $expectedReport)
    {
        $expectedOrder = $this->addWorkersToFixture($workers);

        $workers = array();
        foreach ($this->fixture->getIterator() as $worker) {
            $workers[] = get_class($worker);
        }

        $this->assertSame(
            $expectedOrder,
            $workers
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\PriorityDelegator::createImmutable
     * @uses Axstrad\Component\WorkForce\Team\Immutable\PriorityDelegator
     */
    public function testCreateImmutableMethod()
    {
        $this->assertInstanceOf(
            'Axstrad\Component\WorkForce\Team\Immutable\PriorityDelegator',
            $this->fixture->createImmutable()
        );
    }

    public function workersProvider()
    {
        return array(
            array(
                array(
                    array(1, $this->workerCanWork('one worker')),
                ),
                true,
                $this->getLastCreatedMockReport()
            ),
            array(
                array(
                    array(2, $this->workerCanWork('three workers, two can\'t work')),
                    array(1, $this->workerIsNotUsed()),
                    array(3, $this->workerCanNotWork()),
                ),
                true,
                $this->getLastCreatedMockReport()
            ),
            array(
                array(
                    array(3, $this->workerFailsWork()),
                    array(1, $this->workerIsNotUsed()),
                    array(2, $this->workerCanWork('Three workers, one fails the task')),
                ),
                true,
                $this->getLastCreatedMockReport()
            ),
            array(
                array(
                    array(3, $this->workerFailsWork()),
                    array(2, $this->workerCanWork('Three workers, one fails the task and last isn\'t used')),
                    array(1, $this->workerIsNotUsed()),
                ),
                true,
                $this->getLastCreatedMockReport()
            ),
            array(
                array(
                    array(2, $this->workerCanNotWork()),
                    array(1, $this->workerCanNotWork()),
                ),
                false,
                false
            ),
            array(
                array(
                    array(1, $this->workerFailsWork()),
                    array(2, $this->workerCanNotWork()),
                    array(3, $this->workerFailsWork()),
                ),
                true,
                false
            ),
        );
    }

    protected function addWorkersToFixture(array $workers)
    {
        $expectedOrder = array();
        foreach ($workers as $workerArgs) {
            call_user_func(array($this->fixture, 'addWorker'), $workerArgs[1], $workerArgs[0]);
            $expectedOrder[$workerArgs[0]] = get_class($workerArgs[1]);
        }
        krsort($expectedOrder);
        return array_values($expectedOrder);
    }
}

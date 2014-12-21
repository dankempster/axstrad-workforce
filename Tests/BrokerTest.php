<?php
namespace Axstrad\Component\WorkForce\Tests;

use Axstrad\Component\WorkForce\Broker;
use Axstrad\Component\WorkForce\Test\TestCase;


class BrokerTest extends TestCase
{
    public function setUp()
    {
        $this->fixture = new Broker();
    }

    /**
     * @covers Axstrad\Component\WorkForce\Broker::__construct
     * @covers Axstrad\Component\WorkForce\Broker::getWorkers
     */
    public function testGetWorkersReturnsSplObjectStorage()
    {
        $this->assertInstanceOf(
            'SplObjectStorage',
            $this->fixture->getWorkers()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Broker::addWorker
     * @uses Axstrad\Component\WorkForce\Broker::getWorkers
     * @depends testGetWorkersReturnsSplObjectStorage
     */
    public function testCanAddWorker()
    {
        $mockWorker = $this->createMockWorker();
        $this->fixture->addWorker($mockWorker);

        $this->assertTrue(
            $this->fixture->getWorkers()->contains($mockWorker)
        );
    }

    public function testImplementsIteratorAggregateInterface()
    {
        $this->assertInstanceOf(
            'IteratorAggregate',
            $this->fixture
        );
    }

    /**
     * @depends testImplementsIteratorAggregateInterface
     * @uses Axstrad\Component\WorkForce\Broker::getIterator
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
     * @depends testImplementsIteratorAggregateInterface
     * @uses Axstrad\Component\WorkForce\Broker::getIterator
     * @uses Axstrad\Component\WorkForce\Broker::addWorker
     */
    public function testSplPriorityQueueContainsWorkersInPriorityOrder($workers, $expectedCanWork, $expectedWork)
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
     * @dataProvider workersProvider
     * @depends testSplPriorityQueueContainsWorkersInPriorityOrder
     */
    public function testCanWorkMethod(array $workers, $expectedCanWork, $expectedWork)
    {
        $this->addWorkersToFixture($workers);

        if ($expectedCanWork) {
            $this->assertTrue($this->fixture->canWork(null));
        }
        else {
            $this->assertFalse($this->fixture->canWork(null));
        }
    }

    /**
     * @dataProvider workersProvider
     * @depends testSplPriorityQueueContainsWorkersInPriorityOrder
     */
    public function testWorkMethod(array $workers, $expectedCanWork, $expectedWork)
    {
        $this->addWorkersToFixture($workers);

        $this->assertEquals(
            $expectedWork,
            $this->fixture->work(null)
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Broker::createImmutable
     */
    public function testCreateImmurableMethod()
    {
        $this->assertInstanceOf(
            'Axstrad\Component\WorkForce\ImmutableBroker',
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
                'one worker'
            ),
            array(
                array(
                    array(2, $this->workerCanWork('three workers, two can\'t work')),
                    array(1, $this->workerIsNotUsed()),
                    array(3, $this->workerCanNotWork()),
                ),
                true,
                'three workers, two can\'t work'
            ),
            array(
                array(
                    array(3, $this->workerCanWork(false)),
                    array(1, $this->workerIsNotUsed()),
                    array(2, $this->workerCanWork('Three workers, one fails the task')),
                ),
                true,
                'Three workers, one fails the task'
            ),
            array(
                array(
                    array(3, $this->workerCanWork(false)),
                    array(2, $this->workerCanWork('Three workers, one fails the task and last isn\'t used')),
                    array(1, $this->workerIsNotUsed()),
                ),
                true,
                'Three workers, one fails the task and last isn\'t used'
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
                    array(1, $this->workerCanWork(false)),
                    array(2, $this->workerCanNotWork()),
                    array(3, $this->workerCanWork(false)),
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

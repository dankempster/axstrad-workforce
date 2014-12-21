<?php
namespace Axstrad\Component\WorkForce\Tests;

use Axstrad\Component\WorkForce\Broker;
use Axstrad\Component\WorkForce\ImmutableBroker;
use Axstrad\Component\WorkForce\Test\TestCase;


class ImmutableBrokerTest extends TestCase
{
    protected $broker;
    protected $mockWorker;

    public function setUp()
    {
        $this->broker = new Broker();
        $this->mockWorker = $this->getMockForAbstractClass('Axstrad\Component\WorkForce\Worker');
        $this->broker->addWorker($this->mockWorker, 100);

        $this->fixture = new ImmutableBroker($this->broker);
    }

    public function testConstructorClonesWorkersStorage()
    {
        // The two broker's should have the equal storage and workers
        $this->assertEquals(
            BrokerStorageAccessor::getInternalStorage($this->broker),
            BrokerStorageAccessor::getInternalStorage($this->fixture)
        );

        // The two brokers should not have the sane storage and workers
        $this->assertNotSame(
            BrokerStorageAccessor::getInternalStorage($this->broker),
            BrokerStorageAccessor::getInternalStorage($this->fixture)
        );
    }

    public function testFixtureHasWorkers()
    {
        $this->assertEquals(
            1,
            BrokerStorageAccessor::getInternalStorage($this->fixture)->count()
        );
    }

    /**
     * @expectedException BadMethodCallException
     */
    public function testAddWorkerThrowsException()
    {
        $this->fixture->addWorker(
            $this->getMockForAbstractClass('Axstrad\Component\WorkForce\Worker')
        );
    }
}

class BrokerStorageAccessor extends Broker
{
    public static function getInternalStorage(Broker $broker)
    {
        return $broker->workers;
    }
}

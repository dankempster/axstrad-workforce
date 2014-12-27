<?php
namespace Axstrad\Component\WorkForce\Tests\Unit\Team\Immutable;

use Axstrad\Component\WorkForce\Team\PriorityDelegator;
use Axstrad\Component\WorkForce\Team\Immutable\PriorityDelegator as ImmutablePriorityDelegator;
use Axstrad\Component\WorkForce\Test\TestCase;
use Axstrad\Component\WorkForce\Test\TeamStorageAccessor;


/**
 * @group unit
 * @uses Axstrad\Component\WorkForce\Team\BaseTeam
 * @uses Axstrad\Component\WorkForce\Team\PriorityDelegator
 * @uses Axstrad\Component\WorkForce\Team\Immutable\PriorityDelegator::__construct
 * @uses Axstrad\Component\WorkForce\Test\TeamStorageAccessor
 */
class ImmutablePriorityDelegatorTest extends TestCase
{
    protected $delegator;
    protected $mockWorker;

    /**
     */
    public function setUp()
    {
        $this->delegator = new PriorityDelegator();
        $this->mockWorker = $this->getMockForAbstractClass('Axstrad\Component\WorkForce\Worker');
        $this->delegator->addWorker($this->mockWorker, 100);

        $this->fixture = new ImmutablePriorityDelegator($this->delegator);
    }

    /**
     */
    public function testConstructorClonesWorkersStorage()
    {
        // The two Delegator's should have the equal storage and workers
        $this->assertEquals(
            TeamStorageAccessor::getInternalStorage($this->delegator),
            TeamStorageAccessor::getInternalStorage($this->fixture)
        );

        // The two Delegators should not have the sane storage and workers
        $this->assertNotSame(
            TeamStorageAccessor::getInternalStorage($this->delegator),
            TeamStorageAccessor::getInternalStorage($this->fixture)
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\Immutable\PriorityDelegator::__construct
     */
    public function testFixtureHasFirstMockWorker()
    {
        $this->assertAttributeContains(
            $this->mockWorker,
            "workers",
            $this->fixture
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\Immutable\PriorityDelegator::addWorker
     * @expectedException BadMethodCallException
     */
    public function testAddWorkerThrowsException()
    {
        $this->fixture->addWorker(
            $this->getMockForAbstractClass('Axstrad\Component\WorkForce\Worker')
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\Immutable\PriorityDelegator::removeWorker
     * @expectedException BadMethodCallException
     */
    public function testRemoveWorkerThrowsException()
    {
        $this->fixture->removeWorker(
            $this->getMockForAbstractClass('Axstrad\Component\WorkForce\Worker')
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\Immutable\PriorityDelegator::createImmutable
     */
    public function testCreateImmutableMehtodReturnsSelf()
    {
        $this->assertSame(
            $this->fixture,
            $this->fixture->createImmutable()
        );
    }
}

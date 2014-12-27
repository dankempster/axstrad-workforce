<?php
namespace Axstrad\Component\WorkForce\Tests\Unit\Team\Immutable;

use Axstrad\Component\WorkForce\Team\Delegator;
use Axstrad\Component\WorkForce\Team\Immutable\Delegator as ImmutableDelegator;
use Axstrad\Component\WorkForce\Test\TestCase;
use Axstrad\Component\WorkForce\Test\TeamStorageAccessor;


/**
 * @covers Axstrad\Component\WorkForce\Team\Immutable\Delegator::__construct
 * @group unit
 * @uses Axstrad\Component\WorkForce\Team\BaseTeam
 * @uses Axstrad\Component\WorkForce\Team\Delegator
 * @uses Axstrad\Component\WorkForce\Test\TeamStorageAccessor
 */
class ImmutableDelegatorTest extends TestCase
{
    protected $delegator;
    protected $mockWorker;

    /**
     */
    public function setUp()
    {
        $this->delegator = new Delegator();
        $this->mockWorker = $this->getMockForAbstractClass('Axstrad\Component\WorkForce\Worker');
        $this->delegator->addWorker($this->mockWorker, 100);

        $this->fixture = new ImmutableDelegator($this->delegator);
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
     */
    public function testFixtureHasWorkers()
    {
        $this->assertEquals(
            1,
            TeamStorageAccessor::getInternalStorage($this->fixture)->count()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\Immutable\Delegator::addWorker
     * @expectedException BadMethodCallException
     */
    public function testAddWorkerThrowsException()
    {
        $this->fixture->addWorker(
            $this->getMockForAbstractClass('Axstrad\Component\WorkForce\Worker')
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\Immutable\Delegator::removeWorker
     * @expectedException BadMethodCallException
     */
    public function testRemoveWorkerThrowsException()
    {
        $this->fixture->removeWorker(
            $this->getMockForAbstractClass('Axstrad\Component\WorkForce\Worker')
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\Immutable\Delegator::createImmutable
     */
    public function testCreateImmutableMehtodReturnsSelf()
    {
        $this->assertSame(
            $this->fixture,
            $this->fixture->createImmutable()
        );
    }
}

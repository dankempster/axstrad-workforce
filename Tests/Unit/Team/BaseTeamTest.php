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

namespace Axstrad\Component\WorkForce\Tests\Unit\Team;

use Axstrad\Component\WorkForce\Team\Delegator;
use Axstrad\Component\WorkForce\Test\TestCase;


/**
 * @group unit
 * @covers Axstrad\Component\WorkForce\Team\BaseTeam::__construct
 * @uses Axstrad\Component\WorkForce\Test\TestCase
 */
class BaseTeamTest extends TestCase
{
    public function setUp()
    {
        $this->fixture = $this->getMockForAbstractClass(
            'Axstrad\Component\WorkForce\Team\BaseTeam'
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\BaseTeam::getIterator
     */
    public function testGetIteratorReturnsArrayIterator()
    {
        $this->assertInstanceOf(
            'ArrayIterator',
            $this->fixture->getIterator()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\BaseTeam::getWorkers
     * @uses Axstrad\Component\WorkForce\Team\BaseTeam::getIterator
     */
    public function testGetWorkersReturnsArray()
    {
        $this->assertTrue(
            is_array($this->fixture->getWorkers()),
            'getWorkers() did not return an array.'
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\BaseTeam::addWorker
     * @depends testGetWorkersReturnsArray
     * @uses Axstrad\Component\WorkForce\Team\BaseTeam::getWorkers
     * @uses Axstrad\Component\WorkForce\Team\BaseTeam::getIterator
     */
    public function testCanAddWorker()
    {
        $mockWorker = $this->createMockWorker();
        $this->fixture->addWorker($mockWorker);

        $this->assertContains(
            $mockWorker,
            $this->fixture->getWorkers()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\BaseTeam::count
     * @depends testCanAddWorker
     * @uses Axstrad\Component\WorkForce\Team\BaseTeam::addWorker
     */
    public function testCountMethod()
    {
        $this->assertEquals(0, $this->fixture->count());
        $this->fixture->addWorker($this->createMockWorker());
        $this->assertEquals(1, $this->fixture->count());
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\BaseTeam::addWorker
     * @depends testCanAddWorker
     */
    public function testAddWorkerReturnsSelf()
    {
        $mockWorker = $this->createMockWorker();
        $this->assertSame(
            $this->fixture,
            $this->fixture->addWorker($mockWorker)
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\BaseTeam::removeWorker
     * @depends testCanAddWorker
     * @depends testGetWorkersReturnsArray
     * @uses Axstrad\Component\WorkForce\Team\BaseTeam::addWorker
     * @uses Axstrad\Component\WorkForce\Team\BaseTeam::getWorkers
     * @uses Axstrad\Component\WorkForce\Team\BaseTeam::getIterator
     */
    public function testCanRemoveWorker()
    {
        $mockWorker = $this->createMockWorker();
        $this->fixture->addWorker($mockWorker);
        $this->fixture->removeWorker($mockWorker);

        $this->assertNotContains(
            $mockWorker,
            $this->fixture->getWorkers()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\BaseTeam::removeWorker
     * @depends testCanRemoveWorker
     * @uses Axstrad\Component\WorkForce\Team\BaseTeam::addWorker
     */
    public function testCanRemoveReturnsSelf()
    {
        $mockWorker = $this->createMockWorker();
        $this->fixture->addWorker($mockWorker);
        $this->assertSame(
            $this->fixture,
            $this->fixture->removeWorker($mockWorker)
        );
    }
}

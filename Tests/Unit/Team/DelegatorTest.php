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
 * @uses Axstrad\Component\WorkForce\Report\LazyLoadFactoryTrait
 * @uses Axstrad\Component\WorkForce\Team\BaseTeam
 * @uses Axstrad\Component\WorkForce\Test\TestCase
 */
class DelegatorTest extends TestCase
{
    public function setUp()
    {
        $this->fixture = new Delegator();
        $this->fixture->setFactory(
            $this->createMockFactory()
        );
    }

    /**
     * @dataProvider workersProvider
     * @covers Axstrad\Component\WorkForce\Team\Delegator::canWork
     */
    public function testCanWorkMethod(array $workers, $expectedCanWork, $expectedReport)
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
     * @covers Axstrad\Component\WorkForce\Team\Delegator::work
     */
    public function testWorkMethod(array $workers, $expectedCanWork, $expectedReport)
    {
        $this->addWorkersToFixture($workers);

        if ($expectedReport === false) {
            $this->assertTrue($this->fixture->work('')->isFailure());
        }
        else {
            $this->assertEquals(
                $expectedReport,
                $this->fixture->work(null)
            );
        }
    }

    /**
     * @covers Axstrad\Component\WorkForce\Team\Delegator::createImmutable
     * @uses Axstrad\Component\WorkForce\Team\Immutable\Delegator
     */
    public function testCreateImmutableMethod()
    {
        $this->assertInstanceOf(
            'Axstrad\Component\WorkForce\Team\Immutable\Delegator',
            $this->fixture->createImmutable()
        );
    }

    public function workersProvider()
    {
        return array(
            array(
                array(
                    $this->workerCanWork('one worker'),
                ),
                true,
                $this->getLastCreatedMockReport()
            ),
            array(
                array(
                    $this->workerCanNotWork(),
                    $this->workerCanWork('three workers, two can\'t work'),
                    $this->workerIsNotUsed(),
                ),
                true,
                $this->getLastCreatedMockReport()
            ),
            array(
                array(
                    $this->workerFailsWork(),
                    $this->workerCanWork('Two workers, one fails the task'),
                ),
                true,
                $this->getLastCreatedMockReport()
            ),
            array(
                array(
                    $this->workerFailsWork(),
                    $this->workerCanWork('Three workers, one fails the task and last isn\'t used'),
                    $this->workerIsNotUsed(),
                ),
                true,
                $this->getLastCreatedMockReport()
            ),
            array(
                array(
                    $this->workerCanNotWork(),
                    $this->workerCanNotWork(),
                ),
                false,
                false
            ),
            array(
                array(
                    $this->workerFailsWork(),
                    $this->workerCanNotWork(),
                    $this->workerFailsWork(),
                ),
                true,
                false
            ),
        );
    }

    protected function addWorkersToFixture(array $workers)
    {
        foreach ($workers as $worker) {
            $this->fixture->addWorker($worker);
        }
    }
}

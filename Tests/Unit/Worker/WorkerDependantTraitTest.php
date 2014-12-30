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

namespace Axstrad\Component\WorkForce\Tests\Unit\Worker;

use Axstrad\Component\Test\TraitTestCase;

/**
 * @group unit
 */
class WorkerDependantTraitTest extends TraitTestCase
{
    protected $trait = 'Axstrad\Component\WorkForce\WorkerDependantTrait';


    /**
     * @covers Axstrad\Component\WorkForce\WorkerDependantTrait::getWorker
     */
    public function testWotkerIsNullToStartWith()
    {
        $this->assertNull($this->fixture->getWorker());
    }

    /**
     * @covers Axstrad\Component\WorkForce\WorkerDependantTrait::setWorker
     * @covers Axstrad\Component\WorkForce\WorkerDependantTrait::getWorker
     */
    public function testSetFinder()
    {
        $mockDispacther = $this
            ->getMockForAbstractClass('Axstrad\Component\WorkForce\Worker')
        ;
        $this->fixture->setWorker($mockDispacther);
        $this->assertSame(
            $mockDispacther,
            $this->fixture->getWorker()
        );
    }

    /**
     * @covers Axstrad\Component\WorkForce\WorkerDependantTrait::setWorker
     */
    public function testSetFinderReturnsSelf()
    {
        $mockDispacther = $this
            ->getMockForAbstractClass('Axstrad\Component\WorkForce\Worker')
        ;
        $this->assertSame(
            $this->fixture,
            $this->fixture->setWorker($mockDispacther)
        );
    }
}

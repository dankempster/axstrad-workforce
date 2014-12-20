<?php
namespace Axstrad\Component\WorkForce\Tests;

use Axstrad\Component\Test\TraitTestCase;


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

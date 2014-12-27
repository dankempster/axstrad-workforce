<?php
namespace Axstrad\Component\WorkForce\Tests\Unit\Worker;

use Axstrad\Component\Test\TraitTestCase;


/**
 * @group unit
 */
class WorksAnythingTraitTest extends TraitTestCase
{
    protected $trait = 'Axstrad\Component\WorkForce\Worker\WorksAnythingTrait';


    /**
     * @covers Axstrad\Component\WorkForce\Worker\WorksAnythingTrait::canWork
     */
    public function testCanWorkReturnsTrue()
    {
        $this->assertTrue($this->fixture->canWork(null));
    }
}

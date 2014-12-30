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

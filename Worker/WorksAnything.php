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

namespace Axstrad\Component\WorkForce\Worker;

use Axstrad\Component\WorkForce\Worker;


/**
 * Axstrad\Component\WorkForce\Worker\CatchAll
 */
abstract class CatchAll implements
    Worker
{
    use WorksAnythingTrait;


    /**
     */
    public abstract function work($task);
}

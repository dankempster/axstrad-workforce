<?php
/**
 * This file is part of the Axstrad Library.
 *
 * (c) Dan Kempster <dev@dankempster.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2014-2015 Dan Kempster
 * @author Dan Kempster <dev@dankempster.co.uk>
 */

namespace Axstrad\Component\WorkForce\Worker\NullWorker;

use Axstrad\Component\WorkForce\Report\FailReport;
use Axstrad\Component\WorkForce\Worker;

/**
 * Axstrad\Component\WorkForce\Worker\LazyWorker
 *
 * A lazy worker who won't lift a finger.
 *
 * @package Axstrad/WorkForce
 */
class LazyWorker implements
    Worker
{
    /**
     * Returns a new FailWorker object.
     *
     * @return LazyWorker
     */
    public static function create()
    {
        return new static();
    }

    /**
     * {@inheritDoc}
     *
     * @return boolean Always false
     */
    public function canWork()
    {
        return false;
    }

    /**
     * {@inheritDoc}
     *
     * @return FailReport Returns a FailReport always.
     */
    public function work($task)
    {
        return FailReport::create();
    }
}

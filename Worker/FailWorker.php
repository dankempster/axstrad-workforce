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
 * Axstrad\Component\WorkForce\Worker\FailWorker
 *
 * A positive worker, who will never get the jon done.
 *
 * @package Axstrad/WorkForce
 */
class FailWorker extends WorksAnything
{
    /**
     * Returns a new FailWorker object.
     *
     * @return FailWorker
     */
    public static function create()
    {
        return new static();
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

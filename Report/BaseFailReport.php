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

namespace Axstrad\Component\WorkForce\Report;

use Axstrad\Component\WorkForce\Report;
use PhpOption\None;

/**
 * Axstrad\Component\WorkForce\Report\BaseFailReport
 *
 * Abstract failed report for
 *  - {@see Axstrad\Component\WorkForce\Report\FailReport FailReport}
 *  - {@see Axstrad\Component\WorkForce\Report\NoAbleWorkerReport NoAbleWorkerReport}
 */
abstract class BaseFailReport implements
    Report
{
    /**
     */
    abstract public function getState();

    /**
     */
    public function isSuccessful()
    {
        return false;
    }

    /**
     */
    public function isFailure()
    {
        return true;
    }

    /**
     */
    abstract public function wasWorked();

    /**
     */
    public function hasResult()
    {
        return false;
    }

    /**
     * {@inheritDoc}
     *
     * @return None Always
     */
    public function getResult()
    {
        return None::create();
    }
}

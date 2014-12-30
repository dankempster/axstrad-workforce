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
 * Axstrad\Component\WorkForce\Report\FailReport
 *
 * This report is used by {@see Axstrad\Component\WorkForce\Workers Workers}
 * when they attempted the work, but were unable to complete it.
 */
class FailReport extends BaseFailReport
{
    /**
     */
    public function getState()
    {
        return self::STATE_WAS_WORKED;
    }

    /**
     */
    public function wasWorked()
    {
        return true;
    }
}

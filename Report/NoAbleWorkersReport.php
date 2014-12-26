<?php
namespace Axstrad\Component\WorkForce\Report;

use Axstrad\Component\WorkForce\Report;
use PhpOption\None;

/**
 * Axstrad\Component\WorkForce\Report\NoAbleWorkersReport
 *
 * This report is generally returned by a {@see Axstrad\Component\WorkForce\Team
 * Team} if none of the workers made an attempt to do the work.
 */
class NoAbleWorkersReport extends BaseFailReport
{
    /**
     */
    public function getState()
    {
        return self::STATUS_NO_WORKERS;
    }

    /**
     */
    public function wasWorked()
    {
        return false;
    }
}

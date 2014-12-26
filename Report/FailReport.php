<?php
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

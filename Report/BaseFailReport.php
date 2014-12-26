<?php
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

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
 * Axstrad\Component\WorkForce\Worker\MockWorker
 *
 * A lazy worker, a worker who won't do anything unless told otherwise; And even
 * then they'll only hand in a report, without doing the work.
 *
 * @package Axstrad/WorkForce
 */
class MockWorker implements
    Worker
{
    /**
     * @var boolean The return value for {@see canWork canWork()}.
     */
    private $canWork = false;

    /**
     * @var boolean Whether {@see work work()} should return a SuccessfulReport
     *      or not.
     */
    private $workSuccess = false;


    /**
     * Returns a new MockWorker object.
     *
     * @return MockWorker
     */
    public function create($canWork = false, $workSuccess = null)
    {
        return new static($canWork, $workSuccess);
    }

    /**
     * Class constructor
     *
     * @param boolean $canWork Whether the worker will accept jobs or not.
     * @param mixed $workSuccess What {@see Report report} {@see work
     *        work()} returns:
     *         - true : a SuccessReport
     *         - false : a FailReport
     *         - null : inherits value from $canWork
     *         - any-other : a SuccessReport with this value as the report's
     *           result.
     */
    public function __construct($canWork = false, $workSuccess = null)
    {
        $this->canWork = $canWork;

        $this->reportStatus = ! is_null($workSuccess) ? $workSuccess : $canWork;
    }

    /**
     */
    public function canWork($task)
    {
        return $this->canWork;
    }

    /**
     */
    public function work($task)
    {
        return $this->workSuccess
            ? SuccessReport::create(
                $this->workSuccess !== true ? $this->workSuccess : null
            )
            : FailReport::create()
        ;
    }
}

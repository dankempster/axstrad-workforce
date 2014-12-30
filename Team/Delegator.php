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

namespace Axstrad\Component\WorkForce\Team;

use Axstrad\Component\WorkForce\Report\LazyLoadFactoryTrait as LazyLoadReportFactoryTrait;
use Axstrad\Component\WorkForce\Worker;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Axstrad\Component\WorkForce\Team\Delegator
 *
 * Delegates the work to one of it's workers. It use the first worker that
 * can do the work, in the order the workers were added.
 *
 * If a worker returns a {@see Axstrad\Component\Report\FailReport FailReport}
 * the Delegator will try the next worker until either
 *  - a worker returns a {@see Axstrad\Component\Report\SuccessReport
 *    SuccessReport}; Or
 *  - the delegator runs out of workers to try
 */
class Delegator extends BaseTeam
{
    use LazyLoadReportFactoryTrait;


    /**
     * Can the broker get $task done.
     *
     * The broker will iterate through the Workers in priorty order and test
     * each to see if it can work on $task.
     *
     * @param mixed $task
     * @return boolean True if a single worker can work on $task, False if no
     *         worker can.
     */
    public function canWork($task)
    {
        foreach ($this as $worker) {
            if ($worker->canWork($task)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @{inheritDoc}
     *
     * If after a work instruction a worker returns fail result, the Delegator
     * will continue to try other workers. The Delegator will return the report
     * from the first worker that succeeds.
     *
     * @param mixed $task
     * @return Report
     */
    public function work($task)
    {
        foreach ($this as $worker) {
            if ($worker->canWork($task)) {
                $workerReport = $worker->work($task);
                if ($workerReport->isSuccessful()) {
                    return $workerReport;
                }
            }
        }

        return $this->getFactory()->createNoAbleWorkersReport();
    }

    /**
     * {@inheritDoc}
     *
     * @return Immutable\Delegator
     */
    public function createImmutable()
    {
        return new Immutable\Delegator($this);
    }
}

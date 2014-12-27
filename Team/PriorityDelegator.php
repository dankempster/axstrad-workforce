<?php
namespace Axstrad\Component\WorkForce\Team;

use Axstrad\Component\WorkForce\Report\LazyLoadFactoryTrait;
use Axstrad\Component\WorkForce\Report\SimpleReport;
use Axstrad\Component\WorkForce\Worker;


/**
 * Axstrad\Component\WorkForce\Team\PriorityDelegator
 *
 * Like the {@see Axstrad\Component\WorkForce\Team\Delegator Delegator} this worker
 * delegates the work to one of it's Workers. Unlike {@see
 * Axstrad\Component\WorkForce\Team\Delegator Delegator}, thie worker does it in a
 * priority order.
 */
class PriorityDelegator extends Delegator
{
    /**
     * Class constructor
     *
     * Initalises the worker collection.
     */
    public function __construct()
    {
        $this->workers = new \SplObjectStorage;
    }

    /**
     * {@inheritDoc}
     *
     * @param integer $priority The worker's priority. Defaults to zero.
     *        Multiple Workers with the same priority will get used in no
     *        particular order.
     */
    public function addWorker(Worker $worker, $priority = 0)
    {
        $this->workers->attach($worker, $priority);
        return $this;
    }

    /**
     */
    public function removeWorker(Worker $worker)
    {
        $this->workers->offsetUnset($worker);
        return $this;
    }

    /**
     * @{inheritDoc}
     *
     * @return SplPriorityQueue
     */
    public function getIterator()
    {
        $queue = new \SplPriorityQueue();

        $this->workers->rewind();
        while($this->workers->valid()) {

            $queue->insert(
                $this->workers->current(),
                $this->workers->getInfo()
            );

            $this->workers->next();
        }

        return $queue;
    }

    /**
     * {@inheritDoc}
     *
     * @return Immutable\PriorityDelegator
     */
    public function createImmutable()
    {
        return new Immutable\PriorityDelegator($this);
    }
}

<?php
namespace Axstrad\Component\WorkForce;

/**
 * Axstrad\Component\WorkForce\Broker
 *
 * Delegates the work to one or more Workers based on a priority systsem
 */
class Broker implements
    \IteratorAggregate,
    Worker
{
    /**
     * @var SplObjectStorage
     */
    protected $workers;

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
     * @param Worker $worker The worker to add
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
     * @return SplObjectStorage A clone of the internal storage
     */
    public function getWorkers()
    {
        return clone $this->workers;
    }

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
     * If after a work instruction a worker returns false, the Broker will
     * continue to try other workers. The Broker will return the result from
     * the first worker that succeeds.
     *
     * @param mixed $task
     * @return mixed The worker's result or false
     */
    public function work($task)
    {
        foreach ($this as $worker) {
            if ($worker->canWork($task)) {
                $result = $worker->work($task);
                if ($result !== false) {
                    return $result;
                }
            }
        }
        return false;
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
}

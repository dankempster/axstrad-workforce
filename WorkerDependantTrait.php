<?php
namespace Axstrad\Component\WorkForce;


/**
 * Axstrad\Component\WorkForce\WorkerDependantTrait
 */
trait WorkerDependantTrait
{
    /**
     * @var Worker
     */
    protected $worker;

    /**
     * Get worker
     *
     * @return worker
     * @see setworker
     */
    public function getWorker()
    {
        return $this->worker;
    }

    /**
     * Set worker
     *
     * @param  worker $worker
     * @return self
     * @see getWorker
     */
    public function setWorker(Worker $worker)
    {
        $this->worker = $worker;

        return $this;
    }
}

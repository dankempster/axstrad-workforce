<?php
namespace Axstrad\Component\WorkForce\Team\Immutable;

use Axstrad\Component\WorkForce\Team\PriorityDelegator as BasePriorityDelegator;
use Axstrad\Component\WorkForce\Worker;


/**
 * Axstrad\Component\WorkForce\Team\Immutable\PriorityDelegator
 *
 * An immutable version of
 */
class PriorityDelegator extends BasePriorityDelegator
{
    public function __construct(BasePriorityDelegator $delegator)
    {
        $this->workers = clone $delegator->workers;
    }

    /**
     */
    public function addWorker(Worker $worker)
    {
        throw new \BadMethodCallException("This PriorityDelegator is immutable");
    }

    /**
     */
    public function removeWorker(Worker $worker)
    {
        throw new \BadMethodCallException("This PriorityDelegator is immutable");
    }

    /**
     * {@inheritDoc}
     *
     * @return self
     */
    public function createImmutable()
    {
        return $this;
    }
}

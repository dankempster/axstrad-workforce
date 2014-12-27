<?php
namespace Axstrad\Component\WorkForce\Team\Immutable;

use Axstrad\Component\WorkForce\Team\Delegator as BaseDelegator;
use Axstrad\Component\WorkForce\Worker;


/**
 * Axstrad\Component\WorkForce\Team\Immutable\Delegator
 */
class Delegator extends BaseDelegator
{
    public function __construct(BaseDelegator $delegator)
    {
        $this->workers = clone $delegator->workers;
    }

    /**
     */
    public function addWorker(Worker $worker)
    {
        throw new \BadMethodCallException("This Delegator is immutable");
    }

    /**
     */
    public function removeWorker(Worker $worker)
    {
        throw new \BadMethodCallException("This Delegator is immutable");
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

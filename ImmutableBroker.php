<?php
namespace Axstrad\Component\WorkForce;


/**
 * Axstrad\Component\WorkForce\ImmutableBroker
 */
class ImmutableBroker extends Broker
{
    public function __construct(Broker $broker)
    {
        $this->workers = clone $broker->workers;
    }

    public function addWorker(Worker $worker, $priority = 0)
    {
        throw new \BadMethodCallException("This Broker is immutable");
    }
}

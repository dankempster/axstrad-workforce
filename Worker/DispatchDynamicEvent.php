<?php
namespace Axstrad\Component\WorkForce\Worker;

use Axstrad\Component\WorkForce\Worker;
use Axstrad\Component\WorkForce\WorkerDependantTrait;
use Axstrad\Symfony\EventDispatcher\EventDispatcherAwareTrait;
use Symfony\Component\EventDispatcher\EventDispatcher;


/**
 * Axstrad\Component\WorkForce\Worker\DispatchDynamicEvent
 *
 * Uses another Worker to resolve which event type to dispatch for the task.
 * Then this worker dispatches that event.
 */
class DispatchDynamicEvent implements
    Worker
{
    use EventDispatcherAwareTrait;
    use WorkerDependantTrait {
        WorkerDependantTrait::getWorker as getEventTypeResolver;
        WorkerDependantTrait::setWorker as setEventTypeResolver;
    }


    /**
     * @param EventDispatcher $dispatcher
     * @param Woker $eventTypeResolver A worker that upon being "worked" must
     *        return an array of
     *         - type : the event type to dispatch
     *         - object : the event object to dispatch
     */
    public function __construct(EventDispatcher $dispatcher, Worker $eventTypeResolver)
    {
        $this->setEventDispatcher($dispatcher);
        $this->setEventTypeResolver($eventTypeResolver);
    }

    /**
     */
    public function canWork($task)
    {
        return $this->getEventTypeResolver()->canWork($task);
    }

    /**
     */
    public function work($task)
    {
        $event = $this->getEventTypeResolver()->work($task);

        if ($event === false) {
            return false;
        }

        $this->getEventDispatcher()->dispatch(
            $event['type'],
            $event['object']
        );

        return true;
    }
}

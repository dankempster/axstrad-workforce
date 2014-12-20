<?php
namespace Axstrad\Component\WorkForce\Worker;

use Axstrad\Component\WorkForce\Worker;
use Axstrad\Symfony\EventDispatcher\EventDispatcherAwareTrait;
use Symfony\Component\EventDispatcher\EventDispatcher;


/**
 * Axstrad\Component\WorkForce\Worker\DispatchStaticEvent
 *
 * Dispatches the same event type for all tasks regardless.
 */
class DispatchStaticEvent implements
    Worker
{
    use EventDispatcherAwareTrait;
    use WorksAnythingTrait;


    /**
     * @var string
     */
    protected $eventType;

    /**
     * @var string
     */
    protected $eventClass;


    /**
     * @param EventDispatcher $dispatcher
     * @param string $eventType The type of event to dispatch
     * @param string $eventClass The event class to dispatch
     */
    public function __construct(EventDispatcher $dispatcher, $eventType, $eventClass)
    {
        $this->setEventDispatcher($dispatcher);
        $this->setEventType($eventType);
        $this->setEventClass($eventClass);
    }

    /**
     * Get eventType
     *
     * @return string
     * @see setEventType
     */
    public function getEventType()
    {
        return $this->eventType;
    }

    /**
     * Set eventType
     *
     * @param string $eventType
     * @return self
     * @see getEventType
     */
    public function setEventType($eventType)
    {
        $this->eventType = (string) $eventType;
        return $this;
    }

    /**
     * Get eventClass
     *
     * @return string
     * @see setEventClass
     */
    public function getEventClass()
    {
        return $this->eventClass;
    }

    /**
     * Set eventClass
     *
     * @param string $eventClass
     * @return self
     * @see getEventClass
     */
    public function setEventClass($eventClass)
    {
        $this->eventClass = (string) $eventClass;
        return $this;
    }

    /**
     */
    public function work($task)
    {
        $eventClass = $this->getEventClass();
        $this->getEventDispatcher()->dispatch(
            $this->getEventType(),
            new $eventClass($task)
        );
        return true;
    }
}

<?php
namespace Axstrad\Component\WorkForce;

/**
 * Axstrad\Component\WorkForce\Worker
 */
interface Worker
{
    /**
     * Can the worker work on $task
     *
     * @param mixed $task The task to be worked
     * @return boolean True if the worker can work $task, false otherwise
     */
    public function canWork($task);

    /**
     * Work on $task.
     *
     * @param mixed $task The task to be worked
     * @return mixed true or a positive value on success, false on failure.
     */
    public function work($task);
}

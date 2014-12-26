<?php
namespace Axstrad\Component\WorkForce;

/**
 * Axstrad\Component\WorkForce\Report
 *
 * A Report should be immutable.
 */
interface Report
{
    const STATUS_SUCCESS = 3;
    const STATUS_FAIL = 2;
    const STATUS_NO_WORKERS = 0;

    const STATE_OK = 0x00000001;
    const STATE_WAS_WORKED = 0x00000002;


    /**
     * @return integer Use class constants to test against.
     */
    public function getState();

    /**
     * Was the work a success
     *
     * @return boolean Returns true if {@see getStatus} is
     *         {@see STATUS_SUCCESS}, false otherwise.
     */
    public function isSuccessful();

    /**
     * Was the work a failure
     *
     * @return boolean Returns false if {@see getStatus} is
     *         {@see STATUS_SUCCESS}, true otherwise.
     */
    public function isFailure();

    /**
     * Whether the task was worked on by at least one worker.
     *
     * @return boolean True if at least one workered attempted to work the task,
     *                 False otherwise.
     */
    public function wasWorked();

    /**
     * Whether there was a result for working on the $task.
     *
     * @return boolean
     */
    public function hasResult();

    /**
     * Get the result of the work
     *
     * @return PhpOption\Option
     */
    public function getResult();
}

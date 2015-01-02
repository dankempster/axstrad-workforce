<?php
/**
 * This file is part of the Axstrad Library.
 *
 * (c) Dan Kempster <dev@dankempster.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2014-2015 Dan Kempster
 * @author Dan Kempster <dev@dankempster.co.uk>
 */

namespace Axstrad\Component\WorkForce\Worker\NullWorker;

use Axstrad\Component\WorkForce\Report\FailReport;
use Axstrad\Component\WorkForce\Worker;

/**
 * Axstrad\Component\WorkForce\Worker\SuccessfulWorker
 *
 * A positive worker, who will always says the job is done - without doing
 * anything.
 *
 * @package Axstrad/WorkForce
 */
class SuccessfulWorker extends WorksAnything
{
    /**
     * @var boolean Whether {@see work work()} should return a SuccessfulReport
     *      or not.
     */
    private $result = false;


    /**
     * Returns a new SuccessfulWorker object.
     *
     * @return SuccessfulWorker
     */
    public static function create($result = null)
    {
        return new static($result);
    }

    /**
     * Class constructor
     *
     * @param boolean $canWork Whether the worker will accept jobs or not.
     * @param null|boolean $result The "result" value contained in the {@see
     *        \Axstrad\Component\WorkForce\Report report} returned by {@see work
     *        work()}.
     *
     */
    public function __construct($result = null)
    {
        $this->result = $result;
    }

    /**
     * Returns the result value used by the {@see
     * \Axstrad\Component\WorkForce\Report report} returned by {@see work
     * work()}.
     *
     * @return mixed
     * @see setResult
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * Set the result value used by the {@see
     * \Axstrad\Component\WorkForce\Report report} returned by {@see work
     * work()}.
     *
     * @param mixed $result
     * @return self
     * @see getResult
     */
    public function setResult($result)
    {
        $this->result = $result;
        return $this;
    }

    /**
     */
    public function work($task)
    {
        return SuccessReport::create($this->result);
    }
}

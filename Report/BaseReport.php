<?php
namespace Axstrad\Component\WorkForce\Report;

use Axstrad\Component\WorkForce\Report;
use PhpOption\Option;


/**
 * Axstrad\Component\WorkForce\Report\BaseReport
 */
abstract class BaseReport implements
    Report
{
    /**
     * @var integer
     */
    protected $state = null;

    /**
     * @var Option
     */
    protected $result = null;


    /**
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     */
    public function isSuccessful()
    {
        return ($this->state & self::STATUS_SUCCESS) == self::STATUS_SUCCESS;
    }

    /**
     */
    public function isFailure()
    {
        return !$this->isSuccessful();
    }

    /**
     * @{inheritDoc}
     *
     * @uses getResult()
     */
    public function hasResult()
    {
        return $this->getResult()->isDefined();
    }

    /**
     */
    public function wasWorked()
    {
        return ($this->getState() & self::STATE_WAS_WORKED) == self::STATE_WAS_WORKED;
    }
}

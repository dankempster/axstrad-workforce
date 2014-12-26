<?php
namespace Axstrad\Component\WorkForce\Report;

use Axstrad\Component\WorkForce\Report;
use PhpOption\Option;


/**
 * Axstrad\Component\WorkForce\Report\SuccessReport
 */
class SuccessReport extends BaseReport
{
    /**
     * @param mixed $result
     */
    public function __construct($result = null)
    {
        if (!$result instanceof Option) {
            $result = Option::fromValue($result);
        }
        $this->result = $result;
        $this->state = self::STATUS_SUCCESS;
    }

    /**
     */
    public function getState()
    {
        return self::STATUS_SUCCESS;
    }

    /**
     */
    public function isSuccessful()
    {
        return true;
    }

    /**
     */
    public function isFailure()
    {
        return false;
    }
}

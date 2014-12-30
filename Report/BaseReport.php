<?php
/**
 * This file is part of the Axstrad library.
 *
 * (c) Dan Kempster <dev@dankempster.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright 2014-2015 Dan Kempster <dev@dankempster.co.uk>
 */

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
        return ($this->getState() & self::STATUS_SUCCESS) == self::STATUS_SUCCESS;
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

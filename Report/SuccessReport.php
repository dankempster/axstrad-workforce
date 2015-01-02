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
 * Axstrad\Component\WorkForce\Report\SuccessReport
 */
class SuccessReport extends BaseReport
{
    /**
     * Returns a new SuccessReport object.
     *
     * @return SuccessReport
     */
    public static function create($result = null)
    {
        return new static($result);
    }

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

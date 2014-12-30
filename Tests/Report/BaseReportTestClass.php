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

namespace Axstrad\Component\WorkForce\Tests\Report;

use Axstrad\Component\WorkForce\Report\BaseReport;

/**
 *
 */
class BaseReportTestClass extends BaseReport
{
    public function setState($state)
    {
        $this->state = $state;
    }

    public function setResult($result)
    {
        $this->result = $result;
    }
}

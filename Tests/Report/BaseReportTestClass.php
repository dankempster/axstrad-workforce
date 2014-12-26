<?php
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

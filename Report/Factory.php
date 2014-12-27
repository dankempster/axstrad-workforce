<?php
namespace Axstrad\Component\WorkForce\Report;

use PhpOption\Option;


/**
 * Axstrad\Component\WorkForce\Report\Factory
 */
class Factory
{
    /**
     * @param Option|mixed $result
     * @param mixed $failValue The value to treat as a failure.
     *        When $result is not an {@link
     *        https://github.com/schmittjoh/php-option option). Default is
     *        null.
     * @return Report
     * @uses createSuccessReport If $result is PhpOption\Some object.
     * @uses createFaulureReport If $result is PhpOption\None object.
     */
    public function createFromResult($result, $failValue = null)
    {
        if (!$result instanceof Option) {
            $result = Option::fromValue($result, $failValue);
        }
        if ($result->isDefined()) {
            return $this->createSuccessReport($result);
        }
        else {
            return $this->createFailReport();
        }
    }

    /**
     * @param mixed $result The result of the work. Default is null.
     * @return SuccessReport
     */
    public function createSuccessReport($result = null)
    {
        return new SuccessReport($result);
    }

    /**
     * @return FailureReport
     */
    public function createFailReport()
    {
        return new FailReport();
    }

    /**
     * @return NoAbleWorkerReport
     */
    public function createNoAbleWorkersReport()
    {
        return new NoAbleWorkersReport();
    }

    /**
     * @return NoAbleWorkerReport
     */
    public function createReportBuilder()
    {
        $builder = new ReportBuilder();
        $builder->setFactory($this);
        return $builder;
    }
}

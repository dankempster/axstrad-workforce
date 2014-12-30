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

namespace Axstrad\Component\WorkForce\Team\Immutable;

use Axstrad\Component\WorkForce\Team\PriorityDelegator as BasePriorityDelegator;
use Axstrad\Component\WorkForce\Worker;


/**
 * Axstrad\Component\WorkForce\Team\Immutable\PriorityDelegator
 *
 * An immutable version of
 */
class PriorityDelegator extends BasePriorityDelegator
{
    public function __construct(BasePriorityDelegator $delegator)
    {
        $this->workers = clone $delegator->workers;
    }

    /**
     */
    public function addWorker(Worker $worker)
    {
        throw new \BadMethodCallException("This PriorityDelegator is immutable");
    }

    /**
     */
    public function removeWorker(Worker $worker)
    {
        throw new \BadMethodCallException("This PriorityDelegator is immutable");
    }

    /**
     * {@inheritDoc}
     *
     * @return self
     */
    public function createImmutable()
    {
        return $this;
    }
}

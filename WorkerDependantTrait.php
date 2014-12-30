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

namespace Axstrad\Component\WorkForce;


/**
 * Axstrad\Component\WorkForce\WorkerDependantTrait
 */
trait WorkerDependantTrait
{
    /**
     * @var Worker
     */
    protected $worker;

    /**
     * Get worker
     *
     * @return worker
     * @see setworker
     */
    public function getWorker()
    {
        return $this->worker;
    }

    /**
     * Set worker
     *
     * @param  worker $worker
     * @return self
     * @see getWorker
     */
    public function setWorker(Worker $worker)
    {
        $this->worker = $worker;

        return $this;
    }
}

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

namespace Axstrad\Component\WorkForce\Team;

use Axstrad\Component\WorkForce\Worker;
use Countable;
use IteratorAggregate;


/**
 * Axstrad\Component\WorkForce\Worker\Team
 */
interface Team extends
    Countable,
    IteratorAggregate,
    Worker
{
    /**
     * Adds a worker to the team
     *
     * @param Worker $worker The worker to add
     * @return self
     */
    public function addWorker(Worker $worker);

    /**
     * Remove a Worker from the team
     *
     * @param Worker $worker The worker to remove
     * @return self
     */
    public function removeWorker(Worker $worker);

    /**
     * Get all workers as an array
     *
     * @return Worker[] An array of workers
     */
    public function getWorkers();

    /**
     * Returns an immutable version of this Team.
     *
     * @return Team
     */
    public function createImmutable();
}

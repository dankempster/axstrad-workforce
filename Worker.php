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
 * Axstrad\Component\WorkForce\Worker
 */
interface Worker
{
    /**
     * Can the worker work on $task
     *
     * @param mixed $task The task to be worked
     * @return boolean True if the worker can work $task, false otherwise
     */
    public function canWork($task);

    /**
     * Work on $task.
     *
     * @param mixed $task The task to be worked
     * @return Report A report on the work carried out
     */
    public function work($task);
}

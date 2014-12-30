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

use ArrayIterator;
use Axstrad\Component\WorkForce\Worker;
use Countable;
use Doctrine\Common\Collections\ArrayCollection;


/**
 * Axstrad\Component\WorkForce\Worker\Team
 */
abstract class BaseTeam implements
    Team
{
    /**
     * @var ArrayCollection
     */
    protected $workers;


    /**
     * Class constructor
     *
     * Initalises {@see $workers workers} as an {@link
     * http://www.doctrine-project.org/api/common/2.2/class-Doctrine.Common.Collections.ArrayCollection.html
     * ArrayCollection}.
     */
    public function __construct()
    {
        $this->workers = new ArrayCollection;
    }

    /**
     */
    public function addWorker(Worker $worker)
    {
        if (!$this->workers->contains($worker)) {
            $this->workers->add($worker);
        }
        return $this;
    }

    /**
     */
    public function removeWorker(Worker $worker)
    {
        $this->workers->removeElement($worker);
        return $this;
    }

    /**
     */
    public function getWorkers()
    {
        return iterator_to_array($this);
    }

    /**
     */
    public function getIterator()
    {
        return new ArrayIterator($this->workers->toArray());
    }

    /**
     */
    public function count()
    {
        return $this->workers->count();
    }

    /**
     */
    abstract public function canWork($task);

    /**
     */
    abstract public function work($task);

    /**
     */
    abstract public function createImmutable();
}

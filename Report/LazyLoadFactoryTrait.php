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


/**
 * Axstrad\Component\WorkForce\Report\LazyLoadFactoryTrait
 */
trait LazyLoadFactoryTrait
{
    /**
     * @var Factory
     */
    protected $factory = null;


    /**
     * Get factory
     *
     * Creates a Factory if one isn't defined.
     *
     * @return Factory
     * @see setFactory
     */
    public function getFactory()
    {
        return $this->factory ?: $this->factory = new Factory;
    }

    /**
     * Set factory
     *
     * @param Factory $factory
     * @return self
     * @see getFactory
     */
    public function setFactory(Factory $factory)
    {
        $this->factory = $factory;

        return $this;
    }
}
